@extends('layouts.penyewa')

@section('title', 'Konfirmasi Perpanjangan Kos')

@section('content')
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">

        <h2 class="text-xl font-bold mb-6 text-center">
            Konfirmasi Perpanjangan Kos
        </h2>

        <form method="POST" action="{{ route('penyewa.perpanjang.confirm') }}">
            @csrf

            {{-- Tanggal selesai sekarang --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Tanggal Selesai Sekarang:
                </label>
                <input
                    type="date"
                    class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700"
                    value="{{ $tanggalSekarang }}"
                    readonly>
            </div>

            {{-- Tanggal selesai baru --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Tanggal Selesai Baru:
                </label>
                <input
                    type="date"
                    name="tanggal_selesai_baru"
                    value="{{ $tanggalBaru }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100"
                    readonly>
            </div>

            {{-- Checkbox ganti kamar --}}
            <div class="mb-4 flex items-center gap-2">
                <input
                    type="checkbox"
                    id="ganti_kamar"
                    name="ganti_kamar"
                    value="1"
                    class="w-4 h-4 rounded border-gray-300">
                <label for="ganti_kamar" class="text-sm font-medium text-gray-700">
                    Ingin ganti kamar?
                </label>
            </div>

            {{-- Opsi ganti kamar (hidden default) --}}
            <div id="opsi-kamar" class="hidden space-y-4">

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Pilih Kamar Baru
                    </label>
                    <select
                        name="kamar_id"
                        class="w-full border rounded px-3 py-2">
                        <option value="">-- Pilih kamar --</option>
                        @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->id }}">
                                Kamar {{ $kamar->no_kamar }} ({{ ucfirst($kamar->tipe_kamar) }})
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 mt-6">
                <a
                    href="{{ route('penyewa.perpanjang.index') }}"
                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Lanjutkan ke Pembayaran
                </button>
            </div>
        </form>

    </div>
</div>

{{-- JS toggle --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('ganti_kamar');
        const opsiKamar = document.getElementById('opsi-kamar');

        checkbox.addEventListener('change', function () {
            opsiKamar.classList.toggle('hidden', !this.checked);
        });
    });
</script>
@endsection