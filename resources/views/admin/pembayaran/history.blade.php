@extends('layouts.admin')

@section('page-title', 'History Pembayaran')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-teal-500 text-white">
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
                    @forelse($pembayaran as $item)
                        <tr class="border-b hover:bg-gray-50">
                            {{-- ID Pembayaran --}}
                            <td class="p-3 text-center">{{ $item->id }}</td>

                            {{-- ID Sewa --}}
                            <td class="p-3 text-center">{{ $item->sewa_id }}</td>

                            {{-- Tanggal Bayar --}}
                            <td class="p-3 text-center">
                                {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d-m-Y') }}
                            </td>

                            {{-- Jumlah --}}
                            <td class="p-3 text-right">
                                Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                            </td>

                            {{-- Metode Pembayaran --}}
                            <td class="p-3 text-center">
                                {{ $item->metode_pembayaran }}
                            </td>

                            {{-- Bukti Pembayaran --}}
                            <td class="p-3 text-center">
                                @if($item->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- Jenis Pembayaran --}}
                            <td class="p-3 text-center">
                                {{ $item->jenis_pembayaran }}
                            </td>

                            {{-- Tenggat Pembayaran --}}
                            <td class="p-3 text-center">
                                {{ \Carbon\Carbon::parse($item->tenggat_pembayaran)->format('d-m-Y') }}
                            </td>

                            {{-- Tipe Pembayaran --}}
                            <td class="p-3 text-center">
                                <span class="px-2 py-1 rounded text-white text-xs
                                {{ $item->status_pembayaran == 'Terverifikasi' ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $item->status_pembayaran }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-4 text-center text-gray-500">
                                Data pembayaran belum tersedia
                            </td>
                        </tr>
                    @endforelse
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