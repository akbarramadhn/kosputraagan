<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Feedback;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalKamar' => Kamar::count(),
            'kamarKosong' => Kamar::where('status','Kosong')->count(),
            'penyewaAktif' => Penyewa::whereHas('sewa', function ($q) {
                $q->where('status_sewa','Sewa');
            })->count(),
            'feedbackBaru' => Feedback::where('status_feedback','Belum Dibaca')->count(),
            'pembayaranPending' => Pembayaran::where('status_pembayaran','Sedang Ditinjau')->count(),
        ]);
    }
}

