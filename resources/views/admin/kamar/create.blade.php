@extends('layouts.admin')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-10">
        <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-10">
            Tambah Kamar
        </h1>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- TIPE KAMAR: harus A/B/C --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kamar</label>
                <select name="tipe_kamar"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-teal-400">
                    <option value="" disabled {{ old('tipe_kamar') ? '' : 'selected' }}>Pilih tipe</option>
                    <option value="A" {{ old('tipe_kamar') === 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('tipe_kamar') === 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('tipe_kamar') === 'C' ? 'selected' : '' }}>C</option>
                </select>
                <p class="text-xs text-gray-500 mt-2">Harus salah satu: A, B, atau C.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Perbulan</label>
                <input type="number" name="harga_perbulan" value="{{ old('harga_perbulan') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="contoh: 750000">
                <p class="text-xs text-gray-500 mt-2">Masukkan angka saja (tanpa titik/koma).</p>
            </div>

            {{-- STATUS: namanya status, value harus Kosong/Isi --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Kamar</label>
                <select name="status"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-teal-400">
                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status</option>
                    <option value="Kosong" {{ old('status') === 'Kosong' ? 'selected' : '' }}>Kosong</option>
                    <option value="Isi" {{ old('status') === 'Isi' ? 'selected' : '' }}>Isi</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="Tulis deskripsi kamar...">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- FASILITAS: required --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Fasilitas</label>
                <input type="text" name="fasilitas" value="{{ old('fasilitas') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="contoh: AC, WiFi, Kamar Mandi Dalam">
            </div>

            {{-- FOTO: namanya foto_kos dan required --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Kamar</label>
                <div class="rounded-xl border border-gray-300 px-4 py-3">
                    <input type="file" name="foto_kos" accept="image/*" class="w-full">
                </div>
                <p class="text-xs text-gray-500 mt-2">Wajib upload. Maks 2MB.</p>
            </div>

            <button type="submit"
                class="w-full rounded-xl bg-teal-600 py-3 font-semibold text-white shadow-lg hover:bg-teal-700 transition">
                Tambah Kamar
            </button>
        </form>
    </div>
</div>
@endsection