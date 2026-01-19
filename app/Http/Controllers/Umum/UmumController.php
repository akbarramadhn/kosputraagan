<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\FotoDetailKamar;

class UmumController extends Controller
{
    public function index()
    {
        $roomsA = Kamar::where('tipe_kamar', 'A')
            ->where('status', 'Kosong')
            ->orderBy('no_kamar')
            ->pluck('no_kamar')
            ->values()
            ->toArray();

        $roomsB = Kamar::where('tipe_kamar', 'B')
            ->where('status', 'Kosong')
            ->orderBy('no_kamar')
            ->pluck('no_kamar')
            ->values()
            ->toArray();

        $roomsC = Kamar::where('tipe_kamar', 'C')
            ->where('status', 'Kosong')
            ->orderBy('no_kamar')
            ->pluck('no_kamar')
            ->values()
            ->toArray();

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
        // ambil 1 kamar kosong utk tipe tsb
        $kamar = Kamar::where('tipe_kamar', $tipe)
            ->where('status', 'Kosong')
            ->orderBy('no_kamar')
            ->firstOrFail();

        // ambil kamar kosong lainnya
        $kamarKosong = Kamar::where('tipe_kamar', $tipe)
            ->where('status', 'Kosong')
            ->orderBy('no_kamar')
            ->get(['no_kamar']);

        // 🔥 FOTO DETAIL BERDASARKAN no_kamar (SESUI TABEL KAMU)
        $detailFotos = FotoDetailKamar::where('no_kamar', $kamar->no_kamar)
            ->orderBy('id')
            ->get();

        return view('umum.detail', compact('kamar', 'kamarKosong', 'detailFotos'));
    }

}
