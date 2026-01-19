@extends('layouts.admin')

@section('page-title', 'Edit Data Kamar')

@section('content')
<div class="bg-[#f6f3eb] min-h-screen py-10 px-4">
    <div class="mx-auto max-w-2xl bg-white rounded-2xl shadow-xl p-8">

        <h1 class="text-2xl font-extrabold text-gray-800 text-center mb-8">
            Edit Data Kamar
        </h1>

        {{-- ERROR --}}
        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-xl text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form
            action="{{ route('admin.kamar.update', $kamar->no_kamar) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="font-semibold">Tipe Kamar</label>
                <input type="text" name="tipe_kamar"
                    value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}"
                    class="w-full rounded-xl border px-4 py-3">
            </div>

            <div>
                <label class="font-semibold">Harga Perbulan</label>
                <input type="number" name="harga_perbulan"
                    value="{{ old('harga_perbulan', $kamar->harga_perbulan) }}"
                    class="w-full rounded-xl border px-4 py-3">
            </div>

            <div>
                <label class="font-semibold">Status</label>
                <select name="status" class="w-full rounded-xl border px-4 py-3">
                    <option value="Kosong" {{ $kamar->status == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                    <option value="Isi" {{ $kamar->status == 'Isi' ? 'selected' : '' }}>Isi</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full rounded-xl border px-4 py-3">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="font-semibold">Fasilitas</label>
                <input type="text" name="fasilitas"
                    value="{{ old('fasilitas', $kamar->fasilitas) }}"
                    class="w-full rounded-xl border px-4 py-3">
            </div>

            {{-- FOTO --}}
            <div>
                <label class="font-semibold block mb-2">Foto Kamar</label>

                {{-- FOTO LAMA --}}
                <div class="grid grid-cols-3 gap-3 mb-4">
                    @forelse($kamar->fotoDetail ?? [] as $foto)
                    <img
                        src="{{ asset('storage/' . $foto->foto_path) }}"
                        class="h-24 w-full object-cover rounded-xl border shadow">
                    @empty
                    <p class="text-sm text-gray-500 col-span-3 italic">
                        Belum ada foto kamar
                    </p>
                    @endforelse
                </div>

                {{-- INPUT MULTIPLE --}}
                <input
                    type="file"
                    name="fotos[]"
                    multiple
                    accept="image/*"
                    class="w-full rounded-xl border px-4 py-3">

                <p class="text-sm text-gray-500 mt-1">
                    Bisa upload lebih dari satu foto
                </p>
            </div>

            <button
                type="submit"
                class="w-full bg-teal-600 text-white font-semibold py-3 rounded-xl hover:bg-teal-700">
                Update Kamar
            </button>

        </form>
    </div>
</div>
@endsection