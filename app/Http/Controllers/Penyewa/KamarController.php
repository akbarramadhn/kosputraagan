<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::where('status', 'Kosong')->get();
        return view('penyewa.kamar.index', compact('kamars'));
    }
}