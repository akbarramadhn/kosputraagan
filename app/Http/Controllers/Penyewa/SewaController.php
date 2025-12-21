<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Sewa;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    public function store(Request $request, Kamar $kamar)
    {
        Sewa::create([
            'id_penyewa' => auth()->user()->penyewa->id_penyewa,
            'no_kamar' => $kamar->no_kamar,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonth(),
            'status_sewa' => 'Sewa',
        ]);

        $kamar->update(['status' => 'Isi']);

        return redirect()->route('penyewa.dashboard')
            ->with('success', 'Kamar berhasil disewa');
    }
}