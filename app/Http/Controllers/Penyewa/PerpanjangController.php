<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerpanjangController extends Controller
{
    public function index()
    {
        // ambil penyewa login
        $penyewaId = auth()->user()->penyewa->id_penyewa;

        // ambil sewa AKTIF (status = Sewa)
        $sewaAktif = Sewa::where('id_penyewa', $penyewaId)
            ->where('status_sewa', 'Sewa')
            ->orderBy('tanggal_selesai', 'asc')
            ->first();

        $sisaHari = null;

        if ($sewaAktif) {
            $sisaHari = now()->diffInDays(
                Carbon::parse($sewaAktif->tanggal_selesai),
                false
            );
        }

        return view('penyewa.perpanjang.index', [
            'sewaAktif' => $sewaAktif,
            'sisaHari' => $sisaHari,
        ]);
    }

    public function create()
    {
        $penyewaId = auth()->user()->penyewa->id_penyewa;

        $sewaAktif = Sewa::where('id_penyewa', $penyewaId)
            ->where('status_sewa', 'Sewa')
            ->orderBy('tanggal_selesai', 'asc')
            ->firstOrFail();

        $tanggalSelesaiSekarang = Carbon::parse($sewaAktif->tanggal_selesai);
        $sisaHari = now()->diffInDays($tanggalSelesaiSekarang, false);

        if ($sisaHari > 5) {
            abort(403, 'Perpanjangan hanya bisa dilakukan saat sisa sewa 5 hari atau kurang.');
        }

        $tanggalSelesaiBaru = $tanggalSelesaiSekarang->copy()->addMonth();

        // 🔥 INI YANG KURANG
        $kamars = Kamar::where('status', 'Kosong')->get();

        return view('penyewa.perpanjang.create', [
            'sewaAktif' => $sewaAktif,
            'tanggalSekarang' => $tanggalSelesaiSekarang->toDateString(),
            'tanggalBaru' => $tanggalSelesaiBaru->toDateString(),
            'sisaHari' => $sisaHari,
            'kamars' => $kamars, // ✅ FIX
        ]);
    }

    public function confirm(Request $request)
    {
        // nanti logic real:
        // - insert pembayaran
        // - update sewa.tanggal_selesai
        // - simpan tanggal_selesai_lama

        return redirect()
            ->route('penyewa.perpanjang.index')
            ->with('success', 'Pengajuan perpanjangan berhasil dikirim.');
    }
}
