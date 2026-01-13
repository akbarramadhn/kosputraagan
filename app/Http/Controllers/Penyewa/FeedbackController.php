<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Sewa;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $penyewa = auth()->user()->penyewa;

        $keluhan = Feedback::where('id_penyewa', $penyewa->id_penyewa)
            ->orderByDesc('tanggal_feedback')
            ->paginate(3);

        $sewaAktif = Sewa::with('kamar')
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->where('status_sewa', 'Sewa')
            ->latest('id_sewa') // biar kalau ada lebih dari 1, ambil yang terbaru
            ->first();

        return view('penyewa.keluhan.keluhan', compact('keluhan', 'sewaAktif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_feedback' => 'required|string|min:10',
        ]);

        $penyewa = auth()->user()->penyewa;

        $sewaAktif = Sewa::with('kamar')
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->where('status_sewa', 'Sewa')
            ->latest('id_sewa')
            ->firstOrFail();

        Feedback::create([
            'id_penyewa' => $penyewa->id_penyewa,
            'no_kamar' => $sewaAktif->kamar->no_kamar,
            'tanggal_feedback' => now(),
            'isi_feedback' => $request->isi_feedback,
            'status_feedback' => 'Belum Dibaca',
        ]);

        // ✅ jangan dd lagi, redirect balik + kasih pesan sukses
        return redirect()
            ->route('penyewa.keluhan.index')
            ->with('success', 'Keluhan berhasil dikirim.');
    }
}
