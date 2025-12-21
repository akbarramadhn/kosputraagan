@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Data Penyewa</h1>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">No Telp</th>
                <th class="border p-2">Status Akun</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penyewas as $penyewa)
            <tr>
                <td class="border p-2">{{ $penyewa->user->name }}</td>
                <td class="border p-2">{{ $penyewa->user->email }}</td>
                <td class="border p-2">{{ $penyewa->no_telp_penyewa }}</td>
                <td class="border p-2">{{ $penyewa->status_akun }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection