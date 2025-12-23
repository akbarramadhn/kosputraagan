@extends('layouts.penyewa')

@section('page-title','Ajukan Keluhan')

@section('content')

@if(!$sewaAktif)
    <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
        Kamu belum memiliki sewa aktif.
    </div>
@else
<div class="max-w-xl bg-white p-6 rounded shadow">
    <p class="mb-4 text-sm text-gray-600">
        Kamar: <strong>{{ $sewaAktif->kamar->no_kamar }}</strong>
    </p>

    <form action="{{ route('penyewa.keluhan.store') }}" method="POST">
        @csrf

        <textarea name="isi_feedback" rows="5"
            class="w-full border rounded p-3"
            placeholder="Tuliskan keluhan kamu..."
            required>{{ old('isi_feedback') }}</textarea>

        @error('isi_feedback')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Kirim Keluhan
        </button>
    </form>
</div>
@endif

@endsection