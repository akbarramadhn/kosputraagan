@extends('layouts.admin')

@section('page-title', 'History Pembayaran')

@section('content')
<div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-teal-700 text-white">
            <tr>
                <th class="p-3">ID Pembayaran</th>
                <th class="p-3">ID Sewa</th>
                <th class="p-3">Tanggal Bayar</th>
                <th class="p-3">Jumlah</th>
                <th class="p-3">Metode Pembayaran</th>
                <th class="p-3">Bukti Pembayaran</th>
                <th class="p-3">Jenis Pembayaran</th>
                <th class="p-3">Tenggat Pembayaran</th>
                <th class="p-3">Tipe Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $item->sewa->penyewa->nama ?? '-' }}</td>
                <td class="p-3 text-center">{{ $item->sewa->kamar->no_kamar ?? '-' }}</td>
                <td class="p-3 text-center">{{ $item->tanggal_pembayaran }}</td>
                <td class="p-3 text-right">
                    Rp {{ number_format($item->jumlah_bayar,0,',','.') }}
                </td>
                <td class="p-3 text-center">
                    <span class="px-2 py-1 rounded text-white
                        {{ $item->status_pembayaran == 'Terverifikasi' ? 'bg-green-600' : 'bg-red-600' }}">
                        {{ $item->status_pembayaran }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection