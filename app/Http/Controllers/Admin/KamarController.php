<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FotoDetailKamar;
use App\Models\Kamar;
use App\Models\Sewa;       // ➕ TAMBAHAN
use App\Models\Feedback;  // ➕ TAMBAHAN
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    // daftar kamar
    public function index()
    {
        $kamars = Kamar::orderBy('no_kamar')->paginate(5); 
        return view('admin.kamar.daftar', compact('kamars'));
    }

    // form tambah kamar
    public function create()
    {
        return view('admin.kamar.create');
    }

    // simpan kamar baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipe_kamar' => 'required|in:A,B,C',
            'harga_perbulan' => 'required|numeric',
            'status' => 'required|in:Kosong,Isi',
            'deskripsi' => 'nullable',
            'fasilitas' => 'required',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('fotos')) {
            $firstFoto = $request->file('fotos')[0];
            $data['foto_kos'] = $firstFoto->getClientOriginalName();
        }

        $kamar = Kamar::create($data);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $originalName = $foto->getClientOriginalName();
                $foto->storeAs('kamar', $originalName, 'public');

                $kamar->fotoDetail()->create([
                    'foto_path' => $originalName,
                ]);
            }
        }

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan');
    }

    // edit kamar
    public function edit(Kamar $kamar)
    {
        $kamar->load('fotoDetail');
        return view('admin.kamar.edit', compact('kamar'));
    }

    // update kamar
    public function update(Request $request, Kamar $kamar)
    {
        $data = $request->validate([
            'tipe_kamar' => 'required|in:A,B,C',
            'harga_perbulan' => 'required|numeric',
            'status' => 'required|in:Kosong,Isi',
            'deskripsi' => 'nullable',
            'fasilitas' => 'required',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $kamar->update($data);

        if ($request->hasFile('fotos')) {
            foreach ($kamar->fotoDetail as $foto) {
                Storage::disk('public')->delete('kamar/' . $foto->foto_path);
            }
            $kamar->fotoDetail()->delete();

            foreach ($request->file('fotos') as $foto) {
                $originalName = $foto->getClientOriginalName();
                $foto->storeAs('kamar', $originalName, 'public');

                $kamar->fotoDetail()->create([
                    'foto_path' => $originalName,
                ]);
            }

            $kamar->update([
                'foto_kos' => $request->file('fotos')[0]->getClientOriginalName()
            ]);
        }

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diupdate');
    }

    // hapus kamar
    public function destroy(Kamar $kamar)
    {
        foreach ($kamar->fotoDetail as $foto) {
            Storage::disk('public')->delete('kamar/' . $foto->foto_path);
            $foto->delete();
        }

        // hapus foto utama
        if ($kamar->foto_kos) {
            Storage::disk('public')->delete('kamar/' . $kamar->foto_kos);
        }

        $kamar->delete();

        return back()->with('success', 'Kamar berhasil dihapus');
    }
}
