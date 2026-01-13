<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::with(['penyewa.user', 'kamar'])
            ->orderByDesc('tanggal_feedback')
            ->paginate(5);

        return view('admin.keluhan.keluhan', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_feedback' => 'required|in:Belum Dibaca,Sudah Dibaca,Sedang Diproses,Selesai Ditangani',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'status_feedback' => $request->status_feedback,
        ]);

        return back()->with('success', 'Status keluhan berhasil diperbarui');
    }
}
