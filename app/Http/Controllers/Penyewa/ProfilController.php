<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Sewa;

class ProfilController extends Controller
{
    public function profil()
    {
        $penyewa = auth()->user()->penyewa;

        $sewaAktif = Sewa::with('kamar')
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->where('status_sewa', 'Aktif')
            ->first();

        return view('penyewa.profil', compact('penyewa','sewaAktif'));
    }
}