<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Sewa;
use Illuminate\Http\Request;

class FeedbackController
{
    public function index()
    {
        $penyewa = auth()->user()->penyewa;

        $keluhan = Feedback::where('id_penyewa', $penyewa->id_penyewa)
            ->orderByDesc('tanggal_feedback')
            ->get();

        return view('penyewa.keluhan.keluhan', compact('keluhan'));
    }

    public function create()
    {
        $penyewa = auth()->user()->penyewa;

        // ambil kamar aktif penyewa
        $sewaAktif = Sewa::with('kamar')
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->where('status_sewa', 'Aktif')
            ->first();

        return view('penyewa.keluhan.create', compact('sewaAktif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_feedback' => 'required|string|min:10',
        ]);

        $penyewa = auth()->user()->penyewa;

        $sewaAktif = Sewa::with('kamar')
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->where('status_sewa', 'Aktif')
            ->firstOrFail();

        Feedback::create([
            'id_penyewa' => $penyewa->id_penyewa,
            'no_kamar' => $sewaAktif->kamar->no_kamar,
            'tanggal_feedback' => now(),
            'isi_feedback' => $request->isi_feedback,
            'status_feedback' => 'Baru',
        ]);

        return redirect()->route('penyewa.keluhan.index')
            ->with('success', 'Keluhan berhasil dikirim');
    }
}
