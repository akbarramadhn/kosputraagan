@extends('layouts.penyewa')

@section('title', 'Keluhan Penyewa')
@section('page-title', 'Keluhan')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-xl">

        <!-- Judul -->
        <h2 class="text-xl font-semibold text-center mb-6">
            Riwayat Keluhan Saya
        </h2>

        {{-- ===== RIWAYAT KELUHAN ===== --}}
        @if ($keluhan->isEmpty())
            <p class="text-center text-gray-500 mb-6">
                Tidak ada keluhan yang pernah diajukan.
            </p>
        @else
            <div class="space-y-4 mb-6">
                @foreach ($keluhan as $item)
                    <div class="bg-white rounded-xl shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($item->tanggal_feedback)->format('d M Y') }}
                            </span>

                            <span class="px-3 py-1 text-xs rounded-full font-semibold
                                @if($item->status_feedback == 'Belum Dibaca') bg-gray-200 text-gray-700
                                @elseif($item->status_feedback == 'Sudah Dibaca') bg-blue-100 text-blue-700
                                @elseif($item->status_feedback == 'Sedang Diproses') bg-yellow-100 text-yellow-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ $item->status_feedback }}
                            </span>
                        </div>

                        <p class="text-gray-800">
                            {{ $item->isi_feedback }}
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- ===== PAGINATION (MODEL KAYAK GAMBAR) ===== --}}
            <div class="flex justify-center mb-8">
                {{ $keluhan->onEachSide(1)->links('components.pagination') }}
            </div>
        @endif

        {{-- ===== FORM KELUHAN ===== --}}
        @if(!$sewaAktif)
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-xl shadow">
                Kamu belum memiliki sewa aktif, jadi belum bisa mengajukan keluhan.
            </div>
        @else
            <div class="bg-white rounded-xl shadow p-6">
                <p class="mb-4 text-sm text-gray-600">
                    Kamar: <strong>{{ $sewaAktif->kamar->no_kamar }}</strong>
                </p>

                <form action="{{ route('penyewa.keluhan.store') }}" method="POST">
                    @csrf

                    <label class="block text-sm font-medium mb-2">
                        Ajukan Keluhan Baru
                    </label>

                    <textarea name="isi_feedback"
                        rows="4"
                        class="w-full border rounded px-3 py-2 mb-2 focus:ring focus:ring-teal-300"
                        placeholder="Tulis keluhan Anda di sini..."
                        required>{{ old('isi_feedback') }}</textarea>

                    @error('isi_feedback')
                        <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded font-medium">
                        Kirim Keluhan
                    </button>
                </form>
            </div>
        @endif

    </div>
</div>
@endsection