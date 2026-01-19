@extends('layouts.admin')

@section('title', 'Status Sewa')
@section('page-title', 'Status Sewa Kos')

@section('content')
<div class="bg-white rounded-lg shadow p-4 sm:p-6">

    {{-- WRAPPER TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-xs sm:text-sm md:text-base border-collapse">
            <thead>
                <tr class="bg-teal-500 text-white text-center">
                    <th class="p-2 sm:p-3 whitespace-nowrap">ID Sewa</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">ID Penyewa</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">No. Kamar</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Tanggal Mulai</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Tanggal Selesai</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Tanggal Selesai Lama</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Status Sewa</th>
                </tr>
            </thead>

            <tbody class="bg-[#f5f2ea]">
                @forelse ($sewa as $item)
                    <tr class="border-b text-center hover:bg-gray-50 transition">
                        {{-- ID SEWA --}}
                        <td class="p-2 sm:p-4 text-gray-800">{{ $item->id_sewa }}</td>

                        {{-- ID PENYEWA --}}
                        <td class="p-2 sm:p-4 text-gray-800">{{ $item->id_penyewa }}</td>

                        {{-- NOMOR KAMAR --}}
                        <td class="p-2 sm:p-4 text-gray-800">{{ $item->no_kamar }}</td>

                        {{-- TANGGAL MULAI --}}
                        <td class="p-2 sm:p-4">
                            <div class="leading-5">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d') }}
                                <br>
                                <span class="text-[10px] sm:text-xs text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('H:i:s') }}
                                </span>
                            </div>
                        </td>

                        {{-- TANGGAL SELESAI --}}
                        <td class="p-2 sm:p-4">
                            <div class="leading-5">
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d') }}
                                <br>
                                <span class="text-[10px] sm:text-xs text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('H:i:s') }}
                                </span>
                            </div>
                        </td>

                        {{-- TANGGAL SELESAI LAMA --}}
                        <td class="p-2 sm:p-4">
                            @if($item->tanggal_selesai_lama)
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai_lama)->format('Y-m-d') }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        {{-- STATUS SEWA --}}
                        <td class="p-2 sm:p-4 font-medium text-gray-800">
                            <span class="inline-block px-2 sm:px-3 py-1 rounded-full
                                @if($item->status_sewa == 'Aktif') bg-green-100 text-green-700
                                @elseif($item->status_sewa == 'Selesai') bg-gray-200 text-gray-700
                                @elseif($item->status_sewa == 'Diperpanjang') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ $item->status_sewa }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 sm:p-8 text-center text-gray-500 text-sm sm:text-base">
                            Belum ada data sewa
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if ($sewa->hasPages())
        <div class="mt-4 sm:mt-6 flex justify-center">
            {{ $sewa->links('components.pagination') }}
        </div>
    @endif

</div>
@endsection
