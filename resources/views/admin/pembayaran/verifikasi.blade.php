@extends('layouts.admin')

@section('page-title', 'Verifikasi Pembayaran')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-teal-500 text-white">
                    <tr>
                        <th class="p-3">Penyewa</th>
                        <th class="p-3">Kamar</th>
                        <th class="p-3">Tanggal Bayar</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Bukti</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $item->sewa->penyewa->nama ?? '-' }}</td>
                            <td class="p-3 text-center">{{ $item->sewa->kamar->no_kamar ?? '-' }}</td>
                            <td class="p-3 text-center">{{ $item->tanggal_pembayaran }}</td>
                            <td class="p-3 text-right">
                                Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-center">
                                @if($item->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        Lihat
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <span class="px-2 py-1 rounded text-white
                                {{ $item->status_pembayaran == 'Terverifikasi' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                    {{ $item->status_pembayaran }}
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.pembayaran.verifikasi.show', $item->id_pembayaran) }}"
                                    class="text-blue-600 hover:underline">Verifikasi</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($pembayaran->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $pembayaran->links('components.pagination') }}
            </div>
        @endif
    </div>
@endsection