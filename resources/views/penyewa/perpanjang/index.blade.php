@extends('layouts.penyewa')

@section('title', 'Perpanjang Kos')

@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow p-10 min-h-[80vh]">

        <h1 class="text-2xl font-bold mb-6">Perpanjang Kos</h1>

        <div class="bg-gray-100 rounded-lg shadow p-6 relative overflow-hidden min-h-[180px]">

            <p class="text-gray-600 mb-4">
                Formulir atau tombol perpanjang kos di sini.
            </p>

            <a href="{{ route('penyewa.perpanjang.create') }}" class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700
               {{ $sisaHari > 5 ? 'pointer-events-none opacity-50' : '' }}">
                Perpanjang Sekarang
            </a>

            @if($sisaHari > 5)
                <div class="absolute inset-0 bg-gray-700 bg-opacity-70 flex items-center justify-center rounded-lg">
                    <p class="text-white text-center text-lg font-semibold px-6">
                        Fitur ini akan tersedia saat sisa hari sewa kos kamu tinggal
                        <span class="text-gray-800 font-bold">5 hari atau kurang</span>.
                    </p>
                </div>
            @endif

        </div>
    </div>
@endsection