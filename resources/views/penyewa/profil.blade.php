@extends('layouts.penyewa')

@section('page-title','Profile Penyewa')

@section('content')

{{-- INFORMASI AKUN --}}
<div class="mb-10">
    <h2 class="text-xl font-semibold flex items-center gap-2 mb-4">
        <span class="w-1 h-6 bg-blue-600"></span>
        Informasi Akun
    </h2>

    <div class="bg-white rounded-lg shadow p-6">
        <table class="w-full text-sm">
            <tr class="border-b">
                <td class="py-3 w-48">Nama</td>
                <td>: {{ auth()->user()->name }}</td>
                <td class="text-blue-600 cursor-pointer">Edit</td>
            </tr>
            <tr class="border-b">
                <td class="py-3">Email</td>
                <td>: {{ auth()->user()->email }}</td>
                <td class="text-blue-600 cursor-pointer">Edit</td>
            </tr>
            <tr class="border-b">
                <td class="py-3">No. Telepon</td>
                <td>: {{ $penyewa->no_telp_penyewa }}</td>
                <td class="text-blue-600 cursor-pointer">Edit</td>
            </tr>
            <tr class="border-b">
                <td class="py-3">Password</td>
                <td>: ********</td>
                <td class="text-blue-600 cursor-pointer">Edit</td>
            </tr>
            <tr>
                <td class="py-3">Status Akun</td>
                <td>
                    : <span class="text-green-600 font-semibold">
                        {{ $penyewa->status_akun }}
                      </span>
                </td>
            </tr>
        </table>
    </div>
</div>

{{-- INFORMASI SEWA --}}
<div>
    <h2 class="text-xl font-semibold flex items-center gap-2 mb-4">
        <span class="w-1 h-6 bg-blue-600"></span>
        Informasi Sewa Kos
    </h2>

    <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500 italic">
        @if($sewaAktif)
            Kamar {{ $sewaAktif->kamar?->no_kamar ?? '-' }}<br>
            Status: {{ $sewaAktif->status_sewa }}
        @else
            Belum ada data sewa aktif.
        @endif
    </div>
</div>

@endsection