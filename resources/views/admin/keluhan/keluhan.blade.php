@extends('layouts.admin')

@section('title', 'Keluhan Penyewa')
@section('page-title', 'Keluhan Penyewa')

@section('content')

<div class="bg-white rounded-lg shadow p-4 sm:p-6 md:p-8">
    <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 text-center sm:text-left">Daftar Keluhan Penyewa</h2>

    {{-- TABLE WRAPPER RESPONSIVE --}}
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="min-w-[700px] w-full text-xs sm:text-sm text-left">
            <thead class="bg-teal-500 text-white">
                <tr>
                    <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">No</th>
                    <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">Nama Penyewa</th>
                    <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">Kamar</th>
                    <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">Tanggal</th>
                    <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">Keluhan</th>
                    <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">Status</th>
                    <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-[#f5f2ea]">
                @foreach ($feedback as $item)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-3 sm:px-4 py-2 sm:py-3 text-center">{{ $loop->iteration }}</td>

                        <td class="px-3 sm:px-4 py-2 sm:py-3 text-center">
                            {{ $item->penyewa->user->name ?? '-' }}
                        </td>

                        <td class="px-3 sm:px-4 py-2 sm:py-3 text-center">
                            {{ $item->kamar->no_kamar ?? '-' }}
                        </td>

                        <td class="px-3 sm:px-4 py-2 sm:py-3 text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_feedback)->format('d M Y') }}
                        </td>

                        <td class="px-3 sm:px-4 py-2 sm:py-3 text-center">
                            {{ $item->isi_feedback }}
                        </td>

                        <td class="px-3 sm:px-4 py-2 sm:py-3 text-center">
                            <span class="px-2 sm:px-3 py-1 text-[10px] sm:text-xs rounded-full font-semibold
                                @if($item->status_feedback == 'Belum Dibaca') bg-gray-200 text-gray-700
                                @elseif($item->status_feedback == 'Sudah Dibaca') bg-blue-100 text-blue-700
                                @elseif($item->status_feedback == 'Sedang Diproses') bg-yellow-100 text-yellow-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ $item->status_feedback }}
                            </span>
                        </td>

                        <td class="px-3 sm:px-4 py-2 sm:py-3 text-center">
                            <button
                                data-id="{{ $item->id_feedback }}"
                                data-status="{{ $item->status_feedback }}"
                                onclick="openModal(this)"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm px-3 py-1.5 rounded-lg font-medium transition">
                                Respon
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if ($feedback->hasPages())
      <div class="mt-6 flex justify-center">
        {{ $feedback->links('components.pagination') }}
      </div>
    @endif
</div>

<!-- ================= MODAL ================= -->
<div id="modalKeluhan"
    class="fixed inset-0 hidden z-50 items-center justify-center bg-black bg-opacity-50 px-4 sm:px-0">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm sm:max-w-md p-5 sm:p-6 animate-fade-in">
        <h3 class="text-base sm:text-lg font-semibold mb-4 text-center sm:text-left">Respon Keluhan</h3>

        <form id="formKeluhan" method="POST">
            @csrf
            @method('PUT')

            <label class="block text-sm font-medium mb-2">Status Keluhan</label>
            <select id="statusFeedback"
                name="status_feedback"
                class="w-full border border-gray-300 rounded-lg mb-4 px-3 py-2 text-sm sm:text-base focus:ring-2 focus:ring-teal-400">
                <option value="Belum Dibaca">Belum Dibaca</option> 
                <option value="Sudah Dibaca">Sudah Dibaca</option>
                <option value="Sedang Diproses">Sedang Diproses</option>
                <option value="Selesai Ditangani">Selesai Ditangani</option>
            </select>

            <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3 mt-6">
                <button type="button"
                    onclick="closeModal()"
                    class="px-4 py-2 rounded-lg bg-red-500 text-white text-sm sm:text-base hover:bg-red-600 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm sm:text-base transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    function openModal(button) {
        const id = button.dataset.id;
        const status = button.dataset.status;

        const modal = document.getElementById('modalKeluhan');
        const form = document.getElementById('formKeluhan');
        const select = document.getElementById('statusFeedback');

        form.action = `/admin/keluhan/${id}`;
        select.value = status;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('modalKeluhan');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    .animate-fade-in {
        animation: fadeIn 0.2s ease-out;
    }
</style>

@endsection
