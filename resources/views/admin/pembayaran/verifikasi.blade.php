@extends('layouts.admin')

@section('page-title', 'Verifikasi Pembayaran')

@section('content')
<div class="bg-white rounded-lg shadow p-4 sm:p-6 md:p-8">
    <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 text-center sm:text-left">
        Verifikasi Pembayaran
    </h2>

    {{-- TABLE WRAPPER RESPONSIVE --}}
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="min-w-[900px] w-full text-xs sm:text-sm">
            <thead class="bg-teal-500 text-white">
                <tr>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Id Penyewa</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Id Pembayaran</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Jumlah Bayar</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Bukti Pembayaran</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Jenis Pembayaran</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Status Akun</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Status Pembayaran</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Tipe Pembayaran</th>
                    <th class="p-2 sm:p-3 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pembayaran as $item)
                    @php
                        $penyewa = $item->sewa->penyewa ?? null;
                        $statusAkun = $penyewa->status_akun ?? 'Menunggu Verifikasi';

                        $jenis = strtolower($item->jenis_pembayaran ?? '');
                        $jenisCell = match (true) {
                            str_contains($jenis, 'lunas') => 'bg-emerald-100 text-emerald-700',
                            str_contains($jenis, 'cicil') => 'bg-red-200 text-red-600',
                            default => 'bg-gray-100 text-gray-700',
                        };

                        $akunLower = strtolower($statusAkun);
                        $akunCell = match (true) {
                            str_contains($akunLower, 'menunggu') => 'bg-yellow-100 text-yellow-800',
                            str_contains($akunLower, 'verifikasi') || str_contains($akunLower, 'terverifikasi')
                                => 'bg-emerald-100 text-emerald-700',
                            default => 'bg-gray-100 text-gray-700',
                        };

                        $sp = strtolower($item->status_pembayaran ?? '');
                        $statusBayarCell = match (true) {
                            str_contains($sp, 'terverifikasi') => 'bg-emerald-100 text-emerald-700',
                            str_contains($sp, 'ditinjau') || str_contains($sp, 'menunggu')
                                => 'bg-yellow-100 text-yellow-800',
                            str_contains($sp, 'ditolak') => 'bg-red-200 text-red-600',
                            default => 'bg-gray-100 text-gray-700',
                        };

                        $buktiUrl = $item->bukti_pembayaran
                            ? asset('storage/' . $item->bukti_pembayaran)
                            : null;
                    @endphp

                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-2 sm:p-3 text-center">{{ $penyewa->id_penyewa ?? '-' }}</td>
                        <td class="p-2 sm:p-3 text-center">{{ $item->id_pembayaran ?? $item->id }}</td>

                        <td class="p-2 sm:p-3 text-center whitespace-nowrap">
                            Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                        </td>

                        <td class="p-2 sm:p-3 text-center">
                            @if($buktiUrl)
                                <a href="{{ $buktiUrl }}" target="_blank">
                                    <img src="{{ $buktiUrl }}"
                                         class="h-16 sm:h-20 w-20 sm:w-24 object-cover rounded-lg shadow border border-gray-200">
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="p-2 sm:p-3 text-center font-semibold {{ $jenisCell }}">
                            {{ $item->jenis_pembayaran ?? '-' }}
                        </td>

                        <td class="p-2 sm:p-3 text-center font-semibold {{ $akunCell }}">
                            {{ $statusAkun }}
                        </td>

                        <td class="p-2 sm:p-3 text-center font-semibold {{ $statusBayarCell }}">
                            {{ $item->status_pembayaran ?? '-' }}
                        </td>

                        <td class="p-2 sm:p-3 text-center">
                            {{ $item->tipe_pembayaran ?? '-' }}
                        </td>

                        <td class="p-2 sm:p-3 text-center">
                            <button
                                onclick="openModal('{{ $item->id_pembayaran ?? $item->id }}', '{{ $item->status_pembayaran }}')"
                                class="inline-flex items-center justify-center h-8 sm:h-9 w-8 sm:w-9 rounded bg-blue-600 hover:bg-blue-700 text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.862 3.487a2.25 2.25 0 0 1 3.182 3.182L8.25 18.463
                                             3 19.5l1.037-5.25L16.862 3.487z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if ($pembayaran->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $pembayaran->links('components.pagination') }}
        </div>
    @endif
</div>

{{-- MODAL --}}
<div id="modalEdit"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4 sm:px-0">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm sm:max-w-md p-5 sm:p-6 relative">
        <button onclick="closeModal()"
                class="absolute top-3 right-4 text-gray-400 text-2xl">&times;</button>

        <h2 class="text-base sm:text-lg font-semibold mb-4 text-center sm:text-left">
            Edit Status Pembayaran
        </h2>

        <form id="formEditStatus" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-2">
                    Status Pembayaran
                </label>
                <select name="status_pembayaran" id="status_pembayaran"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm sm:text-base focus:ring-2 focus:ring-teal-400">
                    <option value="Sedang Ditinjau">Sedang Ditinjau</option>
                    <option value="Terverifikasi">Terverifikasi</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>

            <div class="flex flex-col sm:flex-row justify-center sm:justify-end gap-2 sm:gap-3 pt-2">
                <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm sm:text-base transition">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded text-sm sm:text-base transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id, status) {
        const modal  = document.getElementById('modalEdit');
        const form   = document.getElementById('formEditStatus');
        const select = document.getElementById('status_pembayaran');

        form.action = "{{ route('admin.pembayaran.verifikasi.update', ':id') }}"
                        .replace(':id', id);

        select.value = status || 'Sedang Ditinjau';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('modalEdit');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
