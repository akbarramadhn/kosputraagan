@extends('layouts.admin')

@section('page-title', 'History Pembayaran')

@section('content')
  <div class="bg-white rounded-lg shadow p-4 sm:p-6">
    <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 text-center sm:text-left">
      History Pembayaran
    </h2>

    {{-- TABLE WRAPPER RESPONSIVE --}}
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
      <table class="min-w-[900px] w-full text-xs sm:text-sm border-collapse">
        <thead class="bg-teal-500 text-white">
          <tr>
            <th class="p-2 sm:p-3 whitespace-nowrap">ID Pembayaran</th>
            <th class="p-2 sm:p-3 whitespace-nowrap">ID Sewa</th>
            <th class="p-2 sm:p-3 whitespace-nowrap">Tanggal Bayar</th>
            <th class="p-2 sm:p-3 whitespace-nowrap">Jumlah</th>
            <th class="p-2 sm:p-3 whitespace-nowrap">Metode Pembayaran</th>
            <th class="p-2 sm:p-3 whitespace-nowrap">Bukti Pembayaran</th>
            <th class="p-2 sm:p-3 whitespace-nowrap">Jenis Pembayaran</th>
            <th class="p-2 sm:p-3 whitespace-nowrap">Tenggat Pembayaran</th>
            <th class="p-2 sm:p-3 whitespace-nowrap">Tipe Pembayaran</th>
          </tr>
        </thead>

        <tbody>
          @forelse($pembayaran as $item)
            @php
              $jenis = strtolower($item->jenis_pembayaran ?? '');
              $jenisCell = match (true) {
                str_contains($jenis, 'lunas') => 'bg-emerald-100 text-emerald-700',
                str_contains($jenis, 'cicil') => 'bg-red-200 text-red-600',
                default => 'bg-gray-100 text-gray-700',
              };

              $buktiUrl = $item->bukti_pembayaran
                ? asset('storage/' . $item->bukti_pembayaran)
                : null;
            @endphp

            <tr class="border-b hover:bg-gray-50 transition">
              {{-- ID Pembayaran --}}
              <td class="p-2 sm:p-3 text-center">{{ $item->id_pembayaran }}</td>

              {{-- ID Sewa --}}
              <td class="p-2 sm:p-3 text-center">{{ $item->id_sewa }}</td>

              {{-- Tanggal Bayar --}}
              <td class="p-2 sm:p-3 text-center">
                @if($item->tanggal_pembayaran)
                  <div class="leading-5">
                    {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('Y-m-d') }}<br>
                    <span class="text-gray-500 text-[11px] sm:text-xs">
                      {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('H:i:s') }}
                    </span>
                  </div>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>

              {{-- Jumlah --}}
              <td class="p-2 sm:p-3 text-right whitespace-nowrap">
                Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
              </td>

              {{-- Metode Pembayaran --}}
              <td class="p-2 sm:p-3 text-center whitespace-nowrap">
                {{ $item->metode_pembayaran }}
              </td>

              {{-- Bukti Pembayaran --}}
              <td class="p-2 sm:p-3 text-center">
                @if($buktiUrl)
                  <a href="{{ $buktiUrl }}" target="_blank" class="inline-block">
                    <img src="{{ $buktiUrl }}"
                         alt="Bukti Pembayaran"
                         class="h-16 sm:h-20 w-20 sm:w-24 object-cover rounded-lg shadow border border-gray-200">
                  </a>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>

              {{-- Jenis Pembayaran --}}
              <td class="p-2 sm:p-3 text-center font-semibold {{ $jenisCell }} rounded-lg whitespace-nowrap">
                {{ $item->jenis_pembayaran ?? '-' }}
              </td>

              {{-- Tenggat Pembayaran --}}
              <td class="p-2 sm:p-3 text-center">
                @if($item->tenggat_pembayaran)
                  <div class="leading-5">
                    {{ \Carbon\Carbon::parse($item->tenggat_pembayaran)->format('Y-m-d') }}<br>
                    <span class="text-gray-500 text-[11px] sm:text-xs">
                      {{ \Carbon\Carbon::parse($item->tenggat_pembayaran)->format('H:i:s') }}
                    </span>
                  </div>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>

              {{-- Tipe Pembayaran --}}
              <td class="p-2 sm:p-3 text-center whitespace-nowrap">
                {{ $item->tipe_pembayaran ?? '-' }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="p-4 text-center text-gray-500 text-xs sm:text-sm">
                Data pembayaran belum tersedia
              </td>
            </tr>
          @endforelse
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
@endsection
