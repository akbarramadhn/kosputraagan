<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Feedback;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'jumlahKamar' => Kamar::count(),
            'jumlahPenyewa' => Penyewa::count(),
            'jumlahKeluhan' => Feedback::count(),
        ]);
    }
}