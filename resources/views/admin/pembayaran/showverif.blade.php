@extends('layouts.admin')

@section('page-title', 'Detail Verifikasi Pembayaran')

@section('content')
<div class="bg-white shadow rounded-lg p-4 sm:p-6 md:p-8 max-w-3xl mx-auto my-6">
    <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-6 text-center sm:text-left text-gray-800">
        Pembayaran dari {{ $item->sewa->penyewa->nama }}
    </h2>

    <div class="space-y-2 sm:space-y-3 text-sm sm:text-base">
        <p><strong>Kamar:</strong> {{ $item->sewa->kamar->no_kamar }}</p>
        <p><strong>Tanggal Bayar:</strong> {{ $item->tanggal_pembayaran }}</p>
        <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ $item->metode_pembayaran }}</p>

        <p>
            <strong>Bukti Pembayaran:</strong>
            @if($item->bukti_pembayaran)
                <a href="{{ asset('storage/'.$item->bukti_pembayaran) }}" target="_blank"
                   class="text-blue-600 hover:underline break-words">
                    Lihat Bukti Pembayaran
                </a>
            @else
                <span class="text-gray-500">-</span>
            @endif
        </p>
    </div>

    <form action="{{ route('admin.pembayaran.verifikasi.update', $item->id_pembayaran) }}"
          method="POST"
          class="mt-6 sm:mt-8 space-y-5">
        @csrf
        @method('PUT')

        {{-- STATUS PEMBAYARAN --}}
        <div>
            <label class="block text-sm sm:text-base font-semibold text-gray-700 mb-2">
                Status Pembayaran
            </label>
            <select name="status_pembayaran"
                    class="border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-3 w-full focus:ring-2 focus:ring-teal-400 text-sm sm:text-base">
                <option value="Terverifikasi" {{ $item->status_pembayaran == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                <option value="Ditolak" {{ $item->status_pembayaran == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        {{-- BUTTON --}}
        <div class="flex flex-col sm:flex-row justify-center sm:justify-end gap-3 sm:gap-4 pt-2">
            <button type="submit"
                    class="bg-teal-700 hover:bg-teal-800 text-white font-semibold px-4 sm:px-5 py-2 sm:py-3 rounded-lg text-sm sm:text-base transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
