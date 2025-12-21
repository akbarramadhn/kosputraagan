@extends('layouts.admin')

@section('page-title', 'Keluhan Penyewa')

@section('content')
<div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-teal-700 text-white">
            <tr>
                <th class="p-3">Penyewa</th>
                <th class="p-3">Kamar</th>
                <th class="p-3">Tanggal Keluhan</th>
                <th class="p-3">Isi Keluhan</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedback as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $item->sewa->penyewa->nama ?? '-' }}</td>
                <td class="p-3 text-center">{{ $item->sewa->kamar->no_kamar ?? '-' }}</td>
                <td class="p-3 text-center">{{ $item->tanggal_keluhan }}</td>
                <td class="p-3">{{ Str::limit($item->isi_keluhan, 50) }}</td>
                <td class="p-3 text-center">
                    <span class="px-2 py-1 rounded text-white
                        {{ $item->status_keluhan == 'Selesai' ? 'bg-green-600' : ($item->status_keluhan == 'Diproses' ? 'bg-yellow-500' : 'bg-red-600') }}">
                        {{ $item->status_keluhan }}
                    </span>
                </td>
                <td class="p-3 text-center">
                    <a href="{{ route('admin.keluhan.show', $item->id_keluhan) }}"
                       class="text-blue-600 hover:underline">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection