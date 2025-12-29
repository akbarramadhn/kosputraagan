<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();

        // ADMIN -> dashboard admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // PENYEWA -> cek status di tabel penyewa
        if ($user->role === 'penyewa') {
            // ambil status penyewa (aman walau null)
            $status = optional($user->penyewa)->status_akun;

            // kalau belum ada record penyewa, anggap menunggu
            if ($status === null || $status === 'Menunggu Verifikasi') {
                return redirect('/')->with('info', 'Akun kamu masih menunggu verifikasi admin.');
            }

            // kalau sudah terverifikasi
            if ($status === 'Terverifikasi') {
                return redirect()->route('penyewa.profil');
            }

            // fallback kalau value status lain
            return redirect('/');
        }

        return redirect('/');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}