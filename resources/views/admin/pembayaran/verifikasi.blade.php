@extends('layouts.admin')

@section('page-title', 'Verifikasi Pembayaran')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-teal-500 text-white">
                    <tr>
                        <th class="p-3">Id Penyewa</th>
                        <th class="p-3">Id Pembayaran</th>
                        <th class="p-3">Jumlah Bayar</th>
                        <th class="p-3">Bukti Pembayaran</th>
                        <th class="p-3">Jenis Pembayaran</th>
                        <th class="p-3">Status Akun</th>
                        <th class="p-3">Status Pembayaran</th>
                        <th class="p-3">Tipe Pembayaran</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pembayaran as $item)
                        @php
                            // ambil data relasi aman
                            $penyewa = $item->sewa->penyewa ?? null;

                            // status akun (sesuaikan nama kolom kalau beda)
                            $statusAkun = $penyewa->status_akun ?? 'Menunggu Verifikasi';

                            // warna jenis pembayaran
                            $jenis = strtolower($item->jenis_pembayaran ?? '');
                            $jenisCell = match (true) {
                                str_contains($jenis, 'lunas') => 'bg-emerald-100 text-emerald-700',
                                str_contains($jenis, 'cicil') => 'bg-red-200 text-red-600',
                                default => 'bg-gray-100 text-gray-700',
                            };

                            // warna status akun
                            $akunLower = strtolower($statusAkun);
                            $akunCell = match (true) {
                                str_contains($akunLower, 'menunggu') => 'bg-yellow-100 text-yellow-800',
                                str_contains($akunLower, 'verifikasi') || str_contains($akunLower, 'terverifikasi') => 'bg-emerald-100 text-emerald-700',
                                default => 'bg-gray-100 text-gray-700',
                            };

                            // warna status pembayaran
                            $sp = strtolower($item->status_pembayaran ?? '');
                            $statusBayarCell = match (true) {
                                str_contains($sp, 'terverifikasi') => 'bg-emerald-100 text-emerald-700',
                                str_contains($sp, 'ditinjau') || str_contains($sp, 'menunggu') => 'bg-yellow-100 text-yellow-800',
                                str_contains($sp, 'ditolak') => 'bg-red-200 text-red-600',
                                default => 'bg-gray-100 text-gray-700',
                            };

                            $buktiUrl = $item->bukti_pembayaran
                                ? asset('storage/' . $item->bukti_pembayaran)
                                : null;
                        @endphp

                        <tr class="border-b hover:bg-gray-50">
                            {{-- Id Penyewa --}}
                            <td class="p-3 text-center">{{ $penyewa->id_penyewa ?? '-' }}</td>

                            {{-- Id Pembayaran --}}
                            <td class="p-3 text-center">{{ $item->id_pembayaran ?? $item->id }}</td>

                            {{-- Jumlah Bayar --}}
                            <td class="p-3 text-center">
                                Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                            </td>

                            {{-- Bukti Pembayaran (thumbnail) --}}
                            <td class="p-3 text-center">
                                @if($buktiUrl)
                                    <a href="{{ $buktiUrl }}" target="_blank" class="inline-block">
                                        <img src="{{ $buktiUrl }}"
                                             alt="Bukti Pembayaran"
                                             class="h-20 w-24 object-cover rounded-lg shadow">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Jenis Pembayaran (cell berwarna) --}}
                            <td class="p-3 text-center font-semibold {{ $jenisCell }}">
                                {{ $item->jenis_pembayaran ?? '-' }}
                            </td>

                            {{-- Status Akun (cell berwarna) --}}
                            <td class="p-3 text-center font-semibold {{ $akunCell }}">
                                {{ $statusAkun }}
                            </td>

                            {{-- Status Pembayaran (cell berwarna) --}}
                            <td class="p-3 text-center font-semibold {{ $statusBayarCell }}">
                                {{ $item->status_pembayaran ?? '-' }}
                            </td>

                            {{-- Tipe Pembayaran --}}
                            <td class="p-3 text-center">
                                {{ $item->tipe_pembayaran ?? '-' }}
                            </td>

                            {{-- Aksi (ikon edit/verifikasi) --}}
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.pembayaran.verifikasi.show', $item->id_pembayaran ?? $item->id) }}"
                                   class="inline-flex items-center justify-center h-9 w-9 rounded bg-blue-600 text-white">
                                    {{-- icon pensil --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 3.487a2.25 2.25 0 0 1 3.182 3.182L8.25 18.463 3 19.5l1.037-5.25L16.862 3.487z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($pembayaran->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $pembayaran->links('components.pagination') }}
            </div>
        @endif
    </div>
@endsection