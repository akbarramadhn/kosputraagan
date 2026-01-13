@extends('layouts.admin')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-10 bg-gray-50">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-6 sm:p-8 md:p-10">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 text-center mb-6 sm:mb-10">
            Tambah Kamar
        </h1>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700 text-sm sm:text-base">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- TIPE KAMAR --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kamar</label>
                <select name="tipe_kamar"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm sm:text-base">
                    <option value="" disabled {{ old('tipe_kamar') ? '' : 'selected' }}>Pilih tipe</option>
                    <option value="A" {{ old('tipe_kamar') === 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('tipe_kamar') === 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('tipe_kamar') === 'C' ? 'selected' : '' }}>C</option>
                </select>
                <p class="text-xs text-gray-500 mt-2">Harus salah satu: A, B, atau C.</p>
            </div>

            {{-- HARGA --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Perbulan</label>
                <input type="number" name="harga_perbulan" value="{{ old('harga_perbulan') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm sm:text-base"
                    placeholder="contoh: 750000">
                <p class="text-xs text-gray-500 mt-2">Masukkan angka saja (tanpa titik/koma).</p>
            </div>

            {{-- STATUS --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Kamar</label>
                <select name="status"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm sm:text-base">
                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status</option>
                    <option value="Kosong" {{ old('status') === 'Kosong' ? 'selected' : '' }}>Kosong</option>
                    <option value="Isi" {{ old('status') === 'Isi' ? 'selected' : '' }}>Isi</option>
                </select>
            </div>

            {{-- DESKRIPSI --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm sm:text-base"
                    placeholder="Tulis deskripsi kamar...">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- FASILITAS --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Fasilitas</label>
                <input type="text" name="fasilitas" value="{{ old('fasilitas') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm sm:text-base"
                    placeholder="contoh: AC, WiFi, Kamar Mandi Dalam">
            </div>

            {{-- FOTO --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Kamar</label>
                <div class="rounded-xl border border-gray-300 px-3 sm:px-4 py-3">
                    <input type="file" name="foto_kos" accept="image/*" class="w-full text-sm sm:text-base">
                </div>
                <p class="text-xs text-gray-500 mt-2">Wajib upload. Maks 2MB.</p>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                class="w-full rounded-xl bg-teal-600 py-3 font-semibold text-white shadow-lg hover:bg-teal-700 transition text-sm sm:text-base">
                Tambah Kamar
            </button>
        </form>
    </div>
</div>
@endsection
