@extends('layouts.admin')

@section('page-title', 'Edit Data Kamar')

@section('content')
<div class="min-h-screen bg-[#f6f3eb] flex items-start justify-center px-4 py-10">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-10">

        <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-10">
            Edit Data Kamar
        </h1>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kamar.update', $kamar) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- TIPE KAMAR --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kamar</label>
                <input type="text" name="tipe_kamar"
                    value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="Tipe A">
            </div>

            {{-- HARGA --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Perbulan</label>
                <input type="number" name="harga_perbulan"
                    value="{{ old('harga_perbulan', $kamar->harga_perbulan) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="contoh: 1500000">
            </div>

            {{-- STATUS --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Kamar</label>
                <select name="status"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-teal-400">
                    <option value="Kosong" {{ old('status', $kamar->status) === 'Kosong' ? 'selected' : '' }}>Kosong</option>
                    <option value="Isi" {{ old('status', $kamar->status) === 'Isi' ? 'selected' : '' }}>Isi</option>
                </select>
            </div>

            {{-- DESKRIPSI --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="Tulis deskripsi kamar...">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
            </div>

            {{-- FASILITAS --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Fasilitas</label>
                <input type="text" name="fasilitas"
                    value="{{ old('fasilitas', $kamar->fasilitas) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="contoh: AC, WiFi, Kamar Mandi Dalam">
            </div>

            {{-- FOTO --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Kamar</label>

                @if($kamar->foto_kos)
                    <div class="mb-3">
                        <img src="{{ asset('storage/'.$kamar->foto_kos) }}"
                             alt="Foto Kamar"
                             class="h-32 w-48 object-cover rounded-xl border border-gray-200 shadow-sm">
                    </div>
                @endif

                <div class="rounded-xl border border-gray-300 px-4 py-3">
                    <input type="file" name="foto_kos" accept="image/*" class="w-full">
                </div>

                <p class="text-xs text-gray-500 mt-2">
                    Biarkan kosong jika tidak ingin mengganti gambar.
                </p>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                class="w-full rounded-xl bg-teal-600 py-3 font-semibold text-white shadow-lg hover:bg-teal-700 transition">
                Update Kamar
            </button>
        </form>

    </div>
</div>
@endsection