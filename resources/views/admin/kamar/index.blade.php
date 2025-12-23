@extends('layouts.admin')

@section('title', 'Data Kamar')

@section('content')
<div class="bg-white rounded-xl shadow p-6">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Data Kamar</h2>
            <p class="text-sm text-gray-500">Daftar seluruh kamar kos</p>
        </div>

        <a href="{{ route('admin.kamar.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
            + Tambah Kamar
        </a>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b bg-gray-50 text-gray-600">
                    <th class="p-3">No</th>
                    <th class="p-3">Foto</th>
                    <th class="p-3">Tipe</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($kamars as $kamar)
                <tr class="hover:bg-gray-50">
                    <td class="p-3">{{ $loop->iteration }}</td>

                    <td class="p-3">
                        @if($kamar->foto_kos)
                            <img src="{{ asset('storage/'.$kamar->foto_kos) }}"
                                 class="w-16 h-16 object-cover rounded-lg">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </td>

                    <td class="p-3 font-medium">
                        {{ $kamar->tipe_kamar }}
                    </td>

                    <td class="p-3">
                        Rp {{ number_format($kamar->harga_perbulan,0,',','.') }}
                    </td>

                    <td class="p-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $kamar->status === 'Kosong'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700' }}">
                            {{ $kamar->status }}
                        </span>
                    </td>

                    <td class="p-3 text-center space-x-3">
                        <a href="{{ route('admin.kamar.edit', $kamar) }}"
                           class="text-blue-600 hover:underline">
                            Edit
                        </a>

                        <form action="{{ route('admin.kamar.destroy', $kamar) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus kamar ini?')"
                                    class="text-red-600 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-6 text-gray-400">
                        Belum ada data kamar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection