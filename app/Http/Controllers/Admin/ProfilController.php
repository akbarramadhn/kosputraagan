<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin; // <-- tambah ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        return view('admin.profil.edit', compact('user', 'admin'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image|max:2048',
            'no_telp_admin' => 'nullable|string|max:20',
        ]);

        if ($request->filled('name')) {
            $user->name = $validated['name'];
        }

        if ($request->filled('email')) {
            $user->email = $validated['email'];
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        if ($request->filled('no_telp_admin')) {
            Admin::updateOrCreate(
                ['user_id' => $user->id],
                ['no_telp_admin' => (string) $validated['no_telp_admin']]
            );
        }

        return redirect()->route('admin.profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}