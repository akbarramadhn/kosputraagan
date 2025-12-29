<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Sewa;

class BookingController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipe_kamar' => 'required|in:A,B,C',
            'no_kamar' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        session([
            'draft_booking' => [
                'tipe_kamar' => $data['tipe_kamar'],
                'no_kamar' => (int) $data['no_kamar'],
                'tanggal_mulai' => $data['tanggal_mulai'],
                'tanggal_selesai' => $data['tanggal_selesai'],
                'created_at' => now()->toISOString(),
            ]
        ]);

        return redirect()->route('penyewa.pembayaran.form');
    }
}
