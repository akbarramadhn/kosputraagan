<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;

class SewaController extends Controller
{
    public function index()
    {
        $sewas = Sewa::with(['kamar', 'penyewa'])->get();

        return view('admin.sewa.index', compact('sewas'));
    }
}