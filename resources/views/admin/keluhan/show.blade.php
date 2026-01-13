@extends('layouts.admin')

@section('page-title', 'Detail Keluhan')

@section('content')
<div class="bg-white shadow rounded-lg p-4 sm:p-6 md:p-8 max-w-3xl mx-auto my-6">
    <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 text-center sm:text-left">
        Keluhan dari {{ $item->sewa->kamar->no_kamar ?? '-' }}
    </h2>

    <div class="space-y-2 sm:space-y-3 text-sm sm:text-base">
        <p><strong>Kamar:</strong> {{ $item->sewa->kamar->no_kamar ?? '-' }}</p>
        <p><strong>Tanggal Keluhan:</strong> {{ $item->tanggal_keluhan }}</p>
        <p class="leading-relaxed break-words"><strong>Isi Keluhan:</strong> {{ $item->isi_keluhan }}</p>
    </div>

    <form action="{{ route('admin.keluhan.update', $item->id_feedback) }}" method="POST" class="mt-6 sm:mt-8 space-y-5">
        @csrf
        @method('PUT')

        {{-- STATUS --}}
        <div>
            <label class="block text-sm sm:text-base font-semibold text-gray-700 mb-2">
                Status Keluhan
            </label>
            <select name="status_keluhan"
                class="border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-3 w-full focus:ring-2 focus:ring-teal-400 text-sm sm:text-base">
                <option value="Baru" {{ $item->status_keluhan == 'Baru' ? 'selected' : '' }}>Baru</option>
                <option value="Diproses" {{ $item->status_keluhan == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ $item->status_keluhan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        {{-- RESPON ADMIN --}}
        <div>
            <label class="block text-sm sm:text-base font-semibold text-gray-700 mb-2">
                Respon Admin
            </label>
            <textarea name="respon_admin"
                class="border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-3 w-full focus:ring-2 focus:ring-teal-400 text-sm sm:text-base"
                rows="4"
                placeholder="Tuliskan tanggapan atau tindakan admin...">{{ $item->respon_admin }}</textarea>
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
