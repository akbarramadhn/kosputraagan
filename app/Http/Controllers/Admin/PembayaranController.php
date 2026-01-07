<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Kamar;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with([
            'sewa.penyewa', 
            'sewa.kamar'
        ])->orderBy('tanggal_pembayaran')
          ->paginate(5);

        return view('admin.pembayaran.history', compact('pembayaran'));
    }

    public function verifikasiIndex()
    {
        $pembayaran = Pembayaran::with(['sewa.penyewa', 'sewa.kamar'])
            ->where('status_pembayaran', 'Sedang Ditinjau')
            ->orderBy('tanggal_pembayaran', 'desc')
            ->paginate(5);
        return view('admin.pembayaran.verifikasi', compact('pembayaran'));
    }

    // Detail pembayaran
    public function verifikasiShow($id)
    {
        $item = Pembayaran::with(['sewa.penyewa', 'sewa.kamar'])->findOrFail($id);
        return view('admin.pembayaran.verifikasi.show', compact('item'));
    }

    // Update status pembayaran (verifikasi / tolak)
    public function verifikasiUpdate(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:Terverifikasi,Ditolak',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);

        return redirect()->route('admin.pembayaran.verifikasi.index')
                         ->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}