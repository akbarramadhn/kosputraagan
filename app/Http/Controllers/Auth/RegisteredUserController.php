<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Penyewa;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_telp' => ['required'],
        ]);

        DB::transaction(function () use ($request) {

            // 1. create user (breeze)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'penyewa',
            ]);

            // 2. create penyewa detail
            Penyewa::create([
                'user_id' => $user->id,
                'no_telp_penyewa' => $request->no_telp,
                'status_akun' => 'Menunggu Verifikasi',
            ]);

            Auth::login($user);

            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'penyewa') {
                $status = optional($user->penyewa)->status;

                if ($status === null || $status === 'Menunggu Verifikasi') {
                    return redirect('/')->with('info', 'Akun kamu masih menunggu verifikasi admin.');
                }

                if ($status === 'Terverifikasi') {
                    return redirect()->route('penyewa.profil');
                }
            }

            return redirect('/');
        });

        return redirect('/');
    }
}
