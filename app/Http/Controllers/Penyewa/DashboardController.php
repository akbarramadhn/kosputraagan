<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $penyewa = auth()->user()->penyewa;

        $sewaAktif = $penyewa->sewa()
            ->where('status_sewa','Sewa')
            ->with('kamar')
            ->first();

        $pembayaranTerakhir = $sewaAktif?->pembayaran()
            ->latest('tanggal_pembayaran')
            ->first();

        return view('penyewa.dashboard', compact(
            'penyewa',
            'sewaAktif',
            'pembayaranTerakhir'
        ));
    }
}