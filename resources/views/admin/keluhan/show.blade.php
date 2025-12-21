@extends('layouts.admin')

@section('page-title', 'Detail Keluhan')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Keluhan dari {{ $item->sewa->penyewa->nama }}</h2>

    <p><strong>Kamar:</strong> {{ $item->sewa->kamar->no_kamar }}</p>
    <p><strong>Tanggal Keluhan:</strong> {{ $item->tanggal_keluhan }}</p>
    <p><strong>Isi Keluhan:</strong> {{ $item->isi_keluhan }}</p>

    <form action="{{ route('admin.keluhan.update', $item->id_keluhan) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <label class="block mb-2">Status Keluhan</label>
        <select name="status_keluhan" class="border rounded p-2 w-full mb-4">
            <option value="Baru" {{ $item->status_keluhan == 'Baru' ? 'selected' : '' }}>Baru</option>
            <option value="Diproses" {{ $item->status_keluhan == 'Diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="Selesai" {{ $item->status_keluhan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <label class="block mb-2">Respon Admin</label>
        <textarea name="respon_admin" class="border rounded p-2 w-full mb-4" rows="4">{{ $item->respon_admin }}</textarea>

        <button type="submit" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection