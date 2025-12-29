<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penyewa;

class UmumController extends Controller
{
    public function index()
    {
        $roomsA = Kamar::where('tipe_kamar', 'A')->pluck('no_kamar')->values()->toArray();
        $roomsB = Kamar::where('tipe_kamar', 'B')->pluck('no_kamar')->values()->toArray();
        $roomsC = Kamar::where('tipe_kamar', 'C')->pluck('no_kamar')->values()->toArray();


        $jumlahKamar = Kamar::count();
        $jumlahPenyewa = Penyewa::count();

        $sisa = Kamar::query()
            ->selectRaw('tipe_kamar, SUM(CASE WHEN status = "Kosong" THEN 1 ELSE 0 END) as tersedia')
            ->groupBy('tipe_kamar')
            ->pluck('tersedia', 'tipe_kamar');

        return view('welcome', compact('jumlahKamar', 'jumlahPenyewa', 'sisa', 'roomsA', 'roomsB', 'roomsC'));
    }

    public function detailTipe(string $tipe)
    {
        // ambil 1 kamar sebagai "representasi detail tipe"
        $kamar = Kamar::where('tipe_kamar', $tipe)->firstOrFail();

        // galeri foto: ambil semua kamar dengan tipe sama yang punya foto
        $galeri = Kamar::where('tipe_kamar', $tipe)
            ->whereNotNull('foto_kos')
            ->orderBy('no_kamar')
            ->get(['no_kamar', 'foto_kos']);

        // kamar kosong tersedia di sidebar
        $kamarKosong = Kamar::where('tipe_kamar', $tipe)
            ->where('status', 'Kosong')
            ->orderBy('no_kamar')
            ->get(['no_kamar']);

        return view('umum.detail', compact('kamar', 'galeri', 'kamarKosong'));
    }
}