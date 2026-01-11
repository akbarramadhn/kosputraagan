<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Kamar;
use Illuminate\Support\Facades\DB;

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
            ->orderBy('tanggal_pembayaran', 'desc')
            ->paginate(5);

        return view('admin.pembayaran.verifikasi', compact('pembayaran'));
    }

    // Update status pembayaran (verifikasi / tolak)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:Sedang Ditinjau,Terverifikasi,Ditolak'
        ]);

        DB::transaction(function () use ($request, $id) {

            $pembayaran = Pembayaran::with('sewa.penyewa')
                ->where('id_pembayaran', $id)
                ->firstOrFail();

            // update status pembayaran
            $pembayaran->update([
                'status_pembayaran' => $request->status_pembayaran
            ]);

            // aman kalau null
            $tipe = strtolower(trim($pembayaran->tipe_pembayaran ?? ''));

            // LOGIC KHUSUS SEWA BARU
            if ($tipe === 'sewa baru' && $pembayaran->sewa && $pembayaran->sewa->penyewa) {

                $penyewa = $pembayaran->sewa->penyewa;

                // update status akun sesuai status pembayaran
                match ($request->status_pembayaran) {
                    'Sedang Ditinjau' => $penyewa->update([
                        'status_akun' => 'Menunggu Verifikasi'
                    ]),

                    'Terverifikasi' => $penyewa->update([
                        'status_akun' => 'Terverifikasi'
                    ]),

                    'Ditolak' => $penyewa->update([
                        'status_akun' => 'Umum'
                    ]),

                    default => null
                };

                // ✅ TAMBAHAN: kalau DITOLAK -> kamar balik KOSONG
                if ($request->status_pembayaran === 'Ditolak') {
                    Kamar::where('no_kamar', (int) $pembayaran->sewa->no_kamar)
                        ->update([
                            'status' => 'Kosong'
                        ]);
                }

                if ($request->status_pembayaran === 'Terverifikasi') {
                    Kamar::where('no_kamar', (int) $pembayaran->sewa->no_kamar)
                        ->update([
                            'status' => 'Isi' 
                        ]);
                }
            }

            // PERPANJANG -> tidak mengubah status akun & kamar
        });

        return redirect()->back()
            ->with('success', 'Status pembayaran & akun berhasil diupdate');
    }
}