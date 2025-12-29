<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;

class SewaController extends Controller
{
    public function index()
    {
        $sewa = sewa::orderBy('id_sewa',)->paginate(5);

        return view('admin.sewa.index', compact('sewa'));
    }
}