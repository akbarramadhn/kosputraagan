<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::orderBy('no_kamar')->get();
        return view('admin.kamar.index', compact('kamars'));
    }

    public function create()
    {
        return view('admin.kamar.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tipe_kamar' => 'required|in:A,B,C',
            'harga_perbulan' => 'required|numeric',
            'status' => 'required|in:Kosong,Isi',
            'deskripsi' => 'nullable',
            'fasilitas' => 'required',
            'foto_kos' => 'required|image|max:2048',
        ]);

        $data['foto_kos'] = $request->file('foto_kos')
            ->store('kamar', 'public');

        Kamar::create($data);

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan');
    }

    public function edit(Kamar $kamar)
    {
        return view('admin.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $data = $request->validate([
            'tipe_kamar' => 'required|in:A,B,C',
            'harga_perbulan' => 'required|numeric',
            'status' => 'required|in:Kosong,Isi',
            'deskripsi' => 'nullable',
            'fasilitas' => 'required',
            'foto_kos' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_kos')) {
            Storage::disk('public')->delete($kamar->foto_kos);
            $data['foto_kos'] = $request->file('foto_kos')
                ->store('kamar', 'public');
        }

        $kamar->update($data);

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diupdate');
    }

    public function destroy(Kamar $kamar)
    {
        Storage::disk('public')->delete($kamar->foto_kos);
        $kamar->delete();

        return back()->with('success', 'Kamar berhasil dihapus');
    }
}
