<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Sewa;
use App\Models\Feedback;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKamar = Kamar::count();
        $jumlahPenyewa = Penyewa::count();
        $jumlahKeluhan = Feedback::count();
        $jumlahSewa = Sewa::count();

        // Chart
        $dataChart = Sewa::selectRaw('MONTH(tanggal_mulai) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $jumlahPerBulan = array_fill(0, 12, 0);

        foreach ($dataChart as $item) {
            $jumlahPerBulan[$item->bulan - 1] = $item->total;
        }

        return view('admin.dashboard.index', [
            'jumlahKamar' => Kamar::count(),
            'jumlahPenyewa' => Penyewa::count(),
            'jumlahSewa' => Sewa::count(),
            'jumlahKeluhan' => Feedback::count(),
            'jumlahPerBulan' => $jumlahPerBulan
        ]);

    }
}