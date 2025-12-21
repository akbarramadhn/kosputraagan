@extends('layouts.admin')

@section('page-title', 'Detail Verifikasi Pembayaran')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Pembayaran dari {{ $item->sewa->penyewa->nama }}</h2>

    <p><strong>Kamar:</strong> {{ $item->sewa->kamar->no_kamar }}</p>
    <p><strong>Tanggal Bayar:</strong> {{ $item->tanggal_pembayaran }}</p>
    <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($item->jumlah_bayar,0,',','.') }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ $item->metode_pembayaran }}</p>
    <p><strong>Bukti Pembayaran:</strong> 
        @if($item->bukti_pembayaran)
            <a href="{{ asset('storage/'.$item->bukti_pembayaran) }}" target="_blank" class="text-blue-600 hover:underline">
                Lihat
            </a>
        @else
            -
        @endif
    </p>

    <form action="{{ route('admin.pembayaran.verifikasi.update', $item->id_pembayaran) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <label class="block mb-2">Status Pembayaran</label>
        <select name="status_pembayaran" class="border rounded p-2 w-full mb-4">
            <option value="Terverifikasi" {{ $item->status_pembayaran == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
            <option value="Ditolak" {{ $item->status_pembayaran == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>

        <button type="submit" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection