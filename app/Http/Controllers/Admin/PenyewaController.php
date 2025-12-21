<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewa;

class PenyewaController extends Controller
{
    public function index()
    {
        $penyewas = Penyewa::with('user')->get();
        return view('admin.penyewa.index', compact('penyewas'));
    }
}