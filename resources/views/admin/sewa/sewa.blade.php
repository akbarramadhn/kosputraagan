@extends('layouts.admin')

@section('page-title', 'Status Sewa Kos')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-teal-500 text-white text-center">
                        <th class="p-3">Id Sewa</th>
                        <th class="p-3">Id Penyewa</th>
                        <th class="p-3">No. Kamar</th>
                        <th class="p-3">Tanggal Mulai</th>
                        <th class="p-3">Tanggal Selesai</th>
                        <th class="p-3">Tanggal Selesai Lama</th>
                        <th class="p-3">Status Sewa</th>
                    </tr>
                </thead>

                <tbody class="bg-[#f5f2ea]">
                    @forelse ($sewa as $item)
                        <tr class="border-b text-center">
                            <td class="p-4">{{ $item->id_sewa }}</td>
                            <td class="p-4">{{ $item->id_penyewa }}</td>
                            <td class="p-4">{{ $item->no_kamar }}</td>

                            <td class="p-4">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d') }}<br>
                                <span class="text-xs text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('H:i:s') }}
                                </span>
                            </td>

                            <td class="p-4">
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d') }}<br>
                                <span class="text-xs text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('H:i:s') }}
                                </span>
                            </td>

                            <td class="p-4">
                                @if($item->tanggal_selesai_lama)
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai_lama)->format('Y-m-d') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="p-4 font-medium">
                                {{ $item->status_sewa }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-gray-500">
                                Belum ada data sewa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($sewa->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $sewa->links('components.pagination') }}
            </div>
        @endif

    </div>
@endsection