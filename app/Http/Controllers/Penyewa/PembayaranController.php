<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Sewa;
use App\Models\Kamar;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function create()
    {
        $draft = session('draft_booking');

        if (!$draft) {
            return redirect('/#kamar')->with('error', 'Silakan booking dulu sebelum melakukan pembayaran.');
        }

        // (opsional) Expire draft 15 menit
        $created = Carbon::parse($draft['created_at'] ?? now());
        if ($created->diffInMinutes(now()) > 15) {
            session()->forget('draft_booking');
            return redirect('/#kamar')->with('error', 'Sesi booking kamu sudah habis, silakan booking ulang.');
        }

        // ✅ ambil harga kamar dari tabel kamar (harga_perbulan)
        $hargaKamar = Kamar::where('no_kamar', (int) ($draft['no_kamar'] ?? 0))
            ->value('harga_perbulan') ?? 0;

        return view('penyewa.pembayaran.form', compact('draft', 'hargaKamar'));
    }

    public function store(Request $request)
    {
        $draft = session('draft_booking');

        if (!$draft) {
            return redirect('/#kamar')->with('error', 'Draft booking tidak ditemukan. Silakan booking ulang.');
        }

        $data = $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:E-Wallet,Transfer Bank,Cash',
            'tipe_pembayaran' => 'required|in:Sewa Baru,Perpanjang,Pelunasan',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = auth()->user();
        $penyewa = $user?->penyewa;

        if (!$penyewa) {
            return redirect('/#kamar')->with('error', 'Akun kamu belum terdaftar sebagai penyewa.');
        }

        $path = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $sewa = null;

        DB::transaction(function () use ($draft, $data, $penyewa, $path, &$sewa) {
            $mulai = Carbon::parse($draft['tanggal_mulai']);
            $selesai = Carbon::parse($draft['tanggal_selesai']);

            $sewa = Sewa::create([
                'id_penyewa' => $penyewa->id_penyewa,
                'no_kamar' => (int) $draft['no_kamar'],
                'tanggal_mulai' => $mulai,
                'tanggal_selesai' => $selesai,
                'status_sewa' => 'Sewa',
                'tanggal_selesai_lama' => $selesai->toDateString(),
            ]);

            Pembayaran::create([
                'id_sewa' => $sewa->id_sewa,
                'tanggal_pembayaran' => now(),
                'jumlah_bayar' => $data['jumlah_bayar'],
                'metode_pembayaran' => $data['metode_pembayaran'],
                'bukti_pembayaran' => $path,
                'tenggat_pembayaran' => now()->addHours(24),
                'status_pembayaran' => 'Sedang Ditinjau',
                'tipe_pembayaran' => $data['tipe_pembayaran'],
            ]);
        });

        session()->forget('draft_booking');

        return redirect()->route('penyewa.status')
            ->with('success', 'Pembayaran terkirim. Menunggu verifikasi admin.');
    }

    public function status()
    {
        $user = auth()->user();
        $penyewa = $user?->penyewa;

        if (!$penyewa) {
            return redirect('/')->with('error', 'Akun kamu belum terdaftar sebagai penyewa.');
        }

        $sewa = \App\Models\Sewa::with('kamar')
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->latest('id_sewa')
            ->first();

        $pembayaran = null;
        if ($sewa) {
            $pembayaran = \App\Models\Pembayaran::where('id_sewa', $sewa->id_sewa)
                ->latest('tanggal_pembayaran')
                ->first();
        }

        if (!$pembayaran) {
            return redirect('/')->with('error', 'Kamu belum mengisi form pembayaran.');
        }

        return view('penyewa.pembayaran.status', compact('user', 'penyewa', 'sewa', 'pembayaran'));
    }
}