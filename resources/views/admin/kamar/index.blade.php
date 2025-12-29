@extends('layouts.admin')

@section('page-title', 'Data Kamar')

@section('content')

{{-- ALERT --}}
@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

{{-- CARD PUTIH --}}
<div class="bg-white shadow-md rounded-lg p-6 w-full">

    {{-- TABLE WRAP --}}
    <div class="overflow-hidden border border-gray-200 rounded-sm">

        <table class="w-full text-sm text-left">
            {{-- HEADER TEAL --}}
            <thead class="bg-teal-500">
                <tr class="text-white font-semibold">
                    <th class="p-4 text-center whitespace-nowrap">Nomor Kamar</th>
                    <th class="p-4 text-center whitespace-nowrap">Foto Kamar</th>
                    <th class="p-4 text-center whitespace-nowrap">Tipe Kamar</th>
                    <th class="p-4 text-center whitespace-nowrap">Harga Perbulan</th>
                    <th class="p-4 text-center">Deskripsi</th>
                    <th class="p-4 text-center whitespace-nowrap">Fasilitas</th>
                    <th class="p-4 text-center whitespace-nowrap">Status</th>
                    <th class="p-4 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-[#f3f0ea]">
                @forelse($kamars as $kamar)
                    <tr class="border-t border-gray-200">
                        <td class="p-4 text-center">{{ $kamar->no_kamar }}</td>

                        <td class="p-4 text-center">
                            @if($kamar->foto_kos)
                                <img src="{{ asset('storage/'.$kamar->foto_kos) }}"
                                     class="mx-auto h-12 w-20 object-cover rounded-md border border-gray-200">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </td>

                        <td class="p-4 font-medium text-center">
                            {{ $kamar->tipe_kamar }}
                        </td>

                        <td class="p-4 whitespace-nowrap text-center">
                            Rp {{ number_format($kamar->harga_perbulan,0,',','.') }}
                        </td>

                        <td class="p-4 text-gray-700 text-center">
                            {{ $kamar->deskripsi ?? '-' }}
                        </td>

                        <td class="p-4 text-gray-700 text-center">
                            {{ $kamar->fasilitas ?? '-' }}
                        </td>

                        <td class="p-0 text-center font-semibold">
                            @php $kosong = ($kamar->status === 'Kosong'); @endphp
                            <div class="{{ $kosong ? 'bg-red-200 text-red-700' : 'bg-green-200 text-green-700' }} py-6">
                                {{ $kamar->status }}
                            </div>
                        </td>

                        <td class="p-4">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('admin.kamar.edit', $kamar) }}"
                                   class="inline-flex h-9 w-9 items-center justify-center rounded bg-blue-500 text-white hover:bg-blue-600">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('admin.kamar.destroy', $kamar) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus kamar ini?')"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded bg-red-500 text-white hover:bg-red-600">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-6 text-center text-gray-500">
                            Belum ada data kamar
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="mt-4">
        <a href="{{ route('admin.kamar.create') }}"
           class="bg-teal-500 text-white px-5 py-2 rounded-md hover:bg-teal-600">
            Tambah Kamar
        </a>
    </div>

</div>
@endsection