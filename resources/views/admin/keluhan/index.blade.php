@extends('layouts.admin')

@section('page-title', 'Keluhan Penyewa')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-teal-500 text-white">
                    <tr>
                        <th class="p-3">Penyewa</th>
                        <th class="p-3">No Kamar</th>
                        <th class="p-3">Tanggal Feedback</th>
                        <th class="p-3">Isi Feedback</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedback as $item)
                                <tr class="border-b hover:bg-gray-50 text-center">
                                    <td class="p-3">
                                        {{ $item->penyewa->user->name ?? '-' }}
                                    </td>

                                    <td class="p-3 text-center">
                                        {{ $item->kamar->no_kamar ?? '-' }}
                                    </td>

                                    <td class="p-3 text-center">
                                        {{ $item->tanggal_feedback }}
                                    </td>

                                    <td class="p-3 text-center">
                                        {{ Str::limit($item->isi_feedback, 50) }}
                                    </td>

                                    <td class="p-3 text-center">
                                        <span class="px-2 py-1 rounded text-white
                                        {{ $item->status_feedback == 'Selesai Ditangani' ? 'bg-green-600'
                        : ($item->status_feedback == 'Sedang Diproses' ? 'bg-yellow-500'
                            : 'bg-red-600') }}">
                                            {{ $item->status_feedback }}
                                        </span>
                                    </td>

                                    <td class="p-3 text-center">
                                        <a href="{{ route('admin.keluhan.show', $item->id_feedback) }}"
                                            class="text-blue-600 hover:underline">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($feedback->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $feedback->links('components.pagination') }}
            </div>
        @endif
    </div>
@endsection