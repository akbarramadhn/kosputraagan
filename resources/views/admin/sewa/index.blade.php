@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Status Sewa Kos</h2>

<table class="w-full border text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="border p-2">Penyewa</th>
            <th class="border p-2">No Kamar</th>
            <th class="border p-2">Mulai</th>
            <th class="border p-2">Selesai</th>
            <th class="border p-2">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sewas as $sewa)
        <tr>
            <td class="border p-2">{{ $sewa->penyewa->nama_penyewa }}</td>
            <td class="border p-2">{{ $sewa->kamar->no_kamar }}</td>
            <td class="border p-2">{{ $sewa->tanggal_mulai }}</td>
            <td class="border p-2">{{ $sewa->tanggal_selesai }}</td>
            <td class="border p-2">
                <span class="px-2 py-1 rounded
                    {{ $sewa->status_sewa === 'Sewa' ? 'bg-green-200' : 'bg-gray-300' }}">
                    {{ $sewa->status_sewa }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection