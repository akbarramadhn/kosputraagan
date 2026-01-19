<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Sewa;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerpanjangController extends Controller
{
    public function index()
    {
        $penyewaId = auth()->user()->penyewa->id_penyewa;

        $sewaAktif = Sewa::where('id_penyewa', $penyewaId)
            ->where('status_sewa', 'Sewa')
            ->orderBy('tanggal_selesai', 'asc')
            ->first();

        $sisaHari = null;
        if ($sewaAktif) {
            $sisaHari = now()->diffInDays(Carbon::parse($sewaAktif->tanggal_selesai), false);
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

        $kamars = Kamar::where('status', 'Kosong')->get();

        return view('penyewa.perpanjang.create', [
            'sewaAktif' => $sewaAktif,
            'tanggalSekarang' => $tanggalSelesaiSekarang->toDateString(),
            'tanggalBaru' => $tanggalSelesaiBaru->toDateString(),
            'sisaHari' => $sisaHari,
            'kamars' => $kamars,
        ]);
    }

    public function confirm(Request $request)
    {
        $data = $request->validate([
            'tanggal_selesai_baru' => ['required', 'date'],
            'ganti_kamar' => ['nullable', 'boolean'],
            'kamar_id' => ['nullable'], // no_kamar
        ]);

        session([
            'perpanjang.tanggal_selesai_baru' => $data['tanggal_selesai_baru'],
            'perpanjang.ganti_kamar' => $request->boolean('ganti_kamar'),
            'perpanjang.kamar_id' => $data['kamar_id'] ?? null,
        ]);

        return redirect()->route('penyewa.perpanjang.pembayaran');
    }

    public function pembayaran()
    {
        $penyewaId = auth()->user()->penyewa->id_penyewa;

        $sewaAktif = Sewa::where('id_penyewa', $penyewaId)
            ->where('status_sewa', 'Sewa')
            ->orderBy('tanggal_selesai', 'asc')
            ->firstOrFail();

        // pakai session kalau ada (habis confirm), kalau tidak ada pakai tanggal sewa aktif
        $tanggalBaru = session('perpanjang.tanggal_selesai_baru') ?? Carbon::parse($sewaAktif->tanggal_selesai)->toDateString();

        // tentuin kamar dipakai untuk hitung harga (kalau session masih ada dan ganti kamar)
        $noKamarDipakai = $sewaAktif->no_kamar;
        if (session('perpanjang.ganti_kamar') && session('perpanjang.kamar_id')) {
            $noKamarDipakai = session('perpanjang.kamar_id');
        }

        $kamar = Kamar::where('no_kamar', $noKamarDipakai)->first();
        $jumlahBayar = $kamar ? (float) $kamar->harga_perbulan : 0;

        // riwayat pembayaran berdasarkan sewa aktif
        $pembayarans = Pembayaran::where('id_sewa', $sewaAktif->id_sewa)
            ->orderByDesc('tanggal_pembayaran')
            ->get();

        return view('penyewa.perpanjang.pembayaran', [
            'tanggalBaru' => $tanggalBaru,
            'jumlahBayar' => $jumlahBayar,
            'pembayarans' => $pembayarans,
            'butuhConfirm' => !session()->has('perpanjang.tanggal_selesai_baru'), // buat disable tombol kalau mau
        ]);
    }

    public function submitPembayaran(Request $request)
    {
        // wajib confirm dulu sebelum submit
        if (!session()->has('perpanjang.tanggal_selesai_baru')) {
            return redirect()->route('penyewa.perpanjang.index')
                ->with('error', 'Silakan konfirmasi perpanjangan dulu.');
        }

        $request->validate([
            'metode_pembayaran' => ['required', 'in:E-Wallet,Transfer Bank,Cash'],
            'bukti_pembayaran' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:4096'],
        ]);

        $penyewaId = auth()->user()->penyewa->id_penyewa;

        $sewaAktif = Sewa::where('id_penyewa', $penyewaId)
            ->where('status_sewa', 'Sewa')
            ->orderBy('tanggal_selesai', 'asc')
            ->firstOrFail();

        // kamar dipakai (untuk hitung harga + update sewa)
        $noKamarDipakai = $sewaAktif->no_kamar;
        if (session('perpanjang.ganti_kamar') && session('perpanjang.kamar_id')) {
            $noKamarDipakai = session('perpanjang.kamar_id');
        }

        $kamar = Kamar::where('no_kamar', $noKamarDipakai)->first();
        $jumlahBayar = $kamar ? (float) $kamar->harga_perbulan : 0;

        DB::transaction(function () use ($request, $sewaAktif, $noKamarDipakai, $jumlahBayar) {
            $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');

            Pembayaran::create([
                'id_sewa' => $sewaAktif->id_sewa,
                'tanggal_pembayaran' => now(),
                'jumlah_bayar' => $jumlahBayar,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_pembayaran' => $path,
                'jenis_pembayaran' => 'Lunas',          // boleh null
                'tenggat_pembayaran' => now()->addDay(), // opsional
                'status_pembayaran' => 'Sedang Ditinjau',
                'tipe_pembayaran' => 'Perpanjang',
            ]);

            // update sewa aktif
            $sewaAktif->update([
                'tanggal_selesai' => session('perpanjang.tanggal_selesai_baru'),
                'no_kamar' => $noKamarDipakai,
            ]);
        });

        // bersihin session supaya tidak dobel submit
        session()->forget('perpanjang');

        // ⛔ jangan redirect ke pembayaran kalau pembayaran() masih butuh session
        // ✅ karena pembayaran() sudah kita buat aman, ini boleh:
        return redirect()->route('penyewa.pembayaran.riwayatpembayaran')
            ->with('success', 'Pembayaran perpanjang berhasil dikirim, menunggu verifikasi.');
    }
}