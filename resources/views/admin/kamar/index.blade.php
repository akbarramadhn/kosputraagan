@extends('layouts.admin')

@section('title', 'Data Kamar')

@section('content')
<div class="bg-white p-6 rounded shadow">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Data Kamar</h2>

        <a href="{{ route('admin.kamar.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Kamar
        </a>
    </div>

    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">No</th>
                <th class="border p-2">Foto</th>
                <th class="border p-2">Tipe</th>
                <th class="border p-2">Harga</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kamars as $kamar)
                <tr>
                    <td class="border p-2 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="border p-2">
                        @if($kamar->foto_kos)
                            <img src="{{ asset('storage/'.$kamar->foto_kos) }}"
                                 class="w-20 rounded">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </td>

                    <td class="border p-2">{{ $kamar->tipe_kamar }}</td>

                    <td class="border p-2">
                        Rp {{ number_format($kamar->harga_perbulan,0,',','.') }}
                    </td>

                    <td class="border p-2">
                        <span class="px-2 py-1 rounded text-white
                            {{ $kamar->status === 'Kosong' ? 'bg-green-600' : 'bg-red-600' }}">
                            {{ $kamar->status }}
                        </span>
                    </td>

                    <td class="border p-2 space-x-2">
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
                    <td colspan="6" class="text-center p-4">
                        Belum ada data kamar
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection