<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Penyewa;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function profil()
    {
        $penyewa = auth()->user()->penyewa;

        $sewaAktif = Sewa::with('kamar')
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->where('status_sewa', 'Sewa')
            ->first();

        return view('penyewa.profil', compact('penyewa', 'sewaAktif'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'avatar' => ['nullable', 'image', 'max:2048'],

            // khusus penyewa (sesuai DB kamu)
            'no_telp_penyewa' => ['nullable', 'string', 'max:20'],
        ]);

        // update users table
        if ($request->filled('name')) {
            $user->name = $validated['name'];
        }

        if ($request->filled('email')) {
            $user->email = $validated['email'];
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // avatar (HANYA kalau kolom users.avatar ada)
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');

            // kalau kolom avatar tidak ada di tabel users, hapus 2 baris ini
            $user->avatar = $path;
        }

        $user->save();

        // update penyewa.no_telp_penyewa
        if ($request->filled('no_telp_penyewa')) {
            Penyewa::where('user_id', $user->id)->update([
                'no_telp_penyewa' => (string) $validated['no_telp_penyewa'],
            ]);
        }

        return redirect()->route('penyewa.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}