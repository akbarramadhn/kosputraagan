<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;

class SewaController extends Controller
{
    public function index()
    {
        $sewa = Sewa::with(['kamar', 'penyewa'])
            ->orderBy('id_sewa', 'desc')
            ->paginate(5);

        return view('admin.sewa.sewa', compact('sewa'));
    }
}
