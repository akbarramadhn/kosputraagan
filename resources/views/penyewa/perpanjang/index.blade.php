@extends('layouts.penyewa')

@section('title', 'Perpanjang Kos')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Perpanjang Kos</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600 mb-4">
            Formulir atau tombol perpanjang kos di sini.
        </p>

        <a href="{{ route('penyewa.perpanjang.create') }}"
           class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
            Perpanjang Sekarang
        </a>
    </div>
</div>
@endsection