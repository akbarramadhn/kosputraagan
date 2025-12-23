<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerpanjangController extends Controller
{
    public function index()
    {
        return view('penyewa.perpanjang.index');
    }

    public function create()
    {
        // simulasi tanggal sewa
        $tanggalSelesaiSekarang = Carbon::now()->addMonth();
        $tanggalSelesaiBaru = $tanggalSelesaiSekarang->copy()->addYear();

        // ambil semua kamar kosong
        $kamars = Kamar::where('status', 'kosong')->get();

        // ambil tipe kamar unik dari tabel kamar
        $tipeKamars = $kamars->pluck('tipe')->unique();

        return view('penyewa.perpanjang.create', [
            'tanggalSekarang' => $tanggalSelesaiSekarang->toDateString(),
            'tanggalBaru'     => $tanggalSelesaiBaru->toDateString(),
            'kamars'          => $kamars,
            'tipeKamars'      => $tipeKamars,
        ]);
    }

    public function confirm(Request $request)
    {
        return redirect()
            ->route('penyewa.perpanjang.index')
            ->with('success', 'Perpanjangan berhasil diproses (dummy).');
    }

}