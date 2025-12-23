@extends('layouts.admin')

@section('page-title', 'Tambah Kamar')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-4xl">

    {{-- HEADER --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            Tambah Data Kamar
        </h2>
        <p class="text-sm text-gray-500">
            Lengkapi informasi kamar kos
        </p>
    </div>

    <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- TIPE KAMAR --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Tipe Kamar
                </label>
                <input
                    type="text"
                    name="tipe_kamar"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Contoh: A / B / VIP"
                    required
                >
            </div>

            {{-- HARGA --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Harga per Bulan
                </label>
                <input
                    type="number"
                    name="harga_perbulan"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="1500000"
                    required
                >
            </div>

            {{-- FASILITAS --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Fasilitas
                </label>
                <input
                    type="text"
                    name="fasilitas"
                    class="w-full border rounded px-3 py-2"
                    placeholder="AC, KM Dalam, Lemari"
                >
            </div>

            {{-- STATUS (READONLY) --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Status
                </label>
                <input
                    type="text"
                    class="w-full bg-gray-100 border rounded px-3 py-2 text-green-700 font-semibold"
                    value="Kosong"
                    readonly
                >
            </div>

            {{-- DESKRIPSI --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">
                    Deskripsi
                </label>
                <textarea
                    name="deskripsi"
                    rows="3"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Deskripsi singkat kamar"
                ></textarea>
            </div>

            {{-- FOTO --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-2">
                    Foto Kamar
                </label>
                <input
                    type="file"
                    name="foto_kos"
                    class="block w-full text-sm text-gray-600"
                >
                <p class="text-xs text-gray-400 mt-1">
                    JPG / PNG, maksimal 2MB
                </p>
            </div>

        </div>

        {{-- ACTION --}}
        <div class="flex justify-end gap-3 mt-8">
            <a
                href="{{ route('admin.kamar.index') }}"
                class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection