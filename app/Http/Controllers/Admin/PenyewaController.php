<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewa;

class PenyewaController extends Controller
{
    public function index()
    {
        $penyewas = Penyewa::query()
            ->with('user:id,name,email')
            ->orderBy('id_penyewa')
            ->paginate(5);

        return view('admin.penyewa.index', compact('penyewas'));
    }
}