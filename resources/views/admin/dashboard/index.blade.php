@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-[#f3efe6] rounded-xl p-6 text-center shadow">
        <h3 class="text-lg font-semibold">Jumlah Kos</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $jumlahKamar }}</p>
    </div>

    <div class="bg-[#f3efe6] rounded-xl p-6 text-center shadow">
        <h3 class="text-lg font-semibold">Jumlah Penyewa</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $jumlahPenyewa }}</p>
    </div>

    <div class="bg-[#f3efe6] rounded-xl p-6 text-center shadow">
        <h3 class="text-lg font-semibold">Jumlah Keluhan</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $jumlahKeluhan }}</p>
    </div>

</div>
@endsection