<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Sewa;
use App\Models\Feedback;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Halaman utama dashboard admin
     */
    public function dashboard()
    {
        $jumlahKamar = Kamar::count();
        $jumlahPenyewa = Penyewa::count();
        $jumlahKeluhan = Feedback::count();
        $jumlahSewa = Sewa::count();

        // Tahun default (tahun saat ini)
        $tahun = date('Y');

        // Ambil data jumlah sewa per bulan sesuai tahun sekarang
        $dataChart = Sewa::selectRaw('MONTH(tanggal_mulai) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_mulai', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Siapkan array 12 bulan (Jan–Des) dengan nilai default 0
        $jumlahPerBulan = array_fill(0, 12, 0);

        foreach ($dataChart as $item) {
            $jumlahPerBulan[$item->bulan - 1] = $item->total;
        }

        return view('admin.dashboard.dashboard', [
            'jumlahKamar' => $jumlahKamar,
            'jumlahPenyewa' => $jumlahPenyewa,
            'jumlahSewa' => $jumlahSewa,
            'jumlahKeluhan' => $jumlahKeluhan,
            'jumlahPerBulan' => $jumlahPerBulan
        ]);
    }

    /**
     * Mengambil data sewa per bulan berdasarkan tahun tertentu (AJAX)
     */
    public function getSewaPerTahun($tahun)
    {
        // Ambil jumlah sewa tiap bulan untuk tahun yang dipilih
        $dataChart = Sewa::selectRaw('MONTH(tanggal_mulai) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_mulai', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Siapkan array 12 bulan (Jan–Des) default 0
        $jumlahPerBulan = array_fill(0, 12, 0);

        foreach ($dataChart as $item) {
            $jumlahPerBulan[$item->bulan - 1] = $item->total;
        }

        // Kembalikan data dalam format JSON untuk digunakan di Chart.js
        return response()->json($jumlahPerBulan);
    }
}
