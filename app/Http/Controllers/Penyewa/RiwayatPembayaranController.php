<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RiwayatPembayaranController extends Controller
{
    public function index()
    {
        $penyewaId = auth()->user()->penyewa->id_penyewa;

        $pembayarans = DB::table('pembayaran')
            ->join('sewa', 'pembayaran.id_sewa', '=', 'sewa.id_sewa')
            ->where('sewa.id_penyewa', $penyewaId)
            ->select(
                'pembayaran.id_pembayaran',
                'pembayaran.tanggal_pembayaran',
                'sewa.no_kamar',
                'pembayaran.jumlah_bayar',
                'pembayaran.jenis_pembayaran',
                'pembayaran.tenggat_pembayaran',
                'pembayaran.status_pembayaran',
                'pembayaran.bukti_pembayaran',
                'pembayaran.tipe_pembayaran'
            )
            ->orderByDesc('pembayaran.tanggal_pembayaran')
            ->paginate(5);

        return view('penyewa.pembayaran.riwayatpembayaran', compact('pembayarans'));
    }
}
