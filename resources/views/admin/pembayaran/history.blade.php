@extends('layouts.admin')

@section('page-title', 'History Pembayaran')

@section('content')
  <div class="bg-white rounded-lg shadow p-6">

    <div class="overflow-x-auto">
      <table class="w-full text-sm border-collapse">
        <thead class="bg-teal-500 text-white">
          <tr>
            <th class="p-3">ID Pembayaran</th>
            <th class="p-3">ID Sewa</th>
            <th class="p-3">Tanggal Bayar</th>
            <th class="p-3">Jumlah</th>
            <th class="p-3">Metode Pembayaran</th>
            <th class="p-3">Bukti Pembayaran</th>
            <th class="p-3">Jenis Pembayaran</th>
            <th class="p-3">Tenggat Pembayaran</th>
            <th class="p-3">Tipe Pembayaran</th>
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

            <tr class="border-b hover:bg-gray-50">
              {{-- ID Pembayaran --}}
              <td class="p-3 text-center">{{ $item->id_pembayaran }}</td>

              {{-- ID Sewa --}}
              <td class="p-3 text-center">{{ $item->id_sewa }}</td>

              {{-- Tanggal Bayar (tanggal + jam, 2 baris) --}}
              <td class="p-3 text-center">
                @if($item->tanggal_pembayaran)
                  <div class="leading-5">
                    {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('Y-m-d') }}<br>
                    {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('H:i:s') }}
                  </div>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>

              {{-- Jumlah --}}
              <td class="p-3 text-right">
                Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
              </td>

              {{-- Metode Pembayaran --}}
              <td class="p-3 text-center">{{ $item->metode_pembayaran }}</td>

              {{-- Bukti Pembayaran (thumbnail) --}}
              <td class="p-3 text-center">
                @if($buktiUrl)
                  <a href="{{ $buktiUrl }}" target="_blank" class="inline-block">
                    <img src="{{ $buktiUrl }}"
                         alt="Bukti Pembayaran"
                         class="h-20 w-24 object-cover rounded-lg shadow border border-gray-200">
                  </a>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>

              {{-- Jenis Pembayaran (cell berwarna full) --}}
              <td class="p-3 text-center font-semibold {{ $jenisCell }}">
                {{ $item->jenis_pembayaran ?? '-' }}
              </td>

              {{-- Tenggat Pembayaran (tanggal + jam, 2 baris, boleh null) --}}
              <td class="p-3 text-center">
                @if($item->tenggat_pembayaran)
                  <div class="leading-5">
                    {{ \Carbon\Carbon::parse($item->tenggat_pembayaran)->format('Y-m-d') }}<br>
                    {{ \Carbon\Carbon::parse($item->tenggat_pembayaran)->format('H:i:s') }}
                  </div>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>

              {{-- Tipe Pembayaran (ini beneran tipe, bukan status) --}}
              <td class="p-3 text-center">
                {{ $item->tipe_pembayaran ?? '-' }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="p-4 text-center text-gray-500">
                Data pembayaran belum tersedia
              </td>
            </tr>
          @endforelse
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