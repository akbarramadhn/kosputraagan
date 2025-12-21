<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback as Keluhan;

class FeedbackController extends Controller
{
    /**
     * Tampilkan daftar keluhan/feedback.
     */
    public function index()
    {
        $feedback = Keluhan::with(['sewa.penyewa', 'sewa.kamar'])
            ->orderBy('tanggal_feedback', 'desc')
            ->get();

        return view('admin.keluhan.index', compact('feedback'));
    }

    /**
     * Tampilkan detail keluhan/feedback.
     */
    public function show($id)
    {
        $item = Keluhan::with(['sewa.penyewa', 'sewa.kamar'])->findOrFail($id);
        return view('admin.keluhan.show', compact('item'));
    }

    /**
     * Update status dan respon keluhan/feedback.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_keluhan' => 'required|in:Baru,Diproses,Selesai',
            'respon_admin' => 'nullable|string',
        ]);

        $keluhan = Keluhan::findOrFail($id);
        $keluhan->update([
            'status_keluhan' => $request->status_keluhan,
            'respon_admin' => $request->respon_admin
        ]);

        return redirect()->route('admin.feedback.index')
                         ->with('success', 'Keluhan berhasil diperbarui');
    }
}