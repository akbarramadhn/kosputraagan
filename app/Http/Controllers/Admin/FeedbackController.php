<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::with(['penyewa.user', 'kamar'])
            ->orderBy('tanggal_feedback', 'desc')
            ->get();

        return view('admin.keluhan.index', compact('feedback'));
    }

    public function show($id)
    {
        $item = Feedback::with(['penyewa.user', 'kamar'])->findOrFail($id);
        return view('admin.keluhan.show', compact('item'));
    }
}