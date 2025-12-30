@extends('layouts.penyewa')

@section('page-title', 'Keluhan')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-xl">

        <!-- Judul -->
        <h2 class="text-xl font-semibold text-center mb-2">
            Riwayat Keluhan Saya
        </h2>

        <!-- Info kosong -->
        <p class="text-center text-gray-500 mb-6">
            Tidak ada keluhan yang pernah diajukan.
        </p>

        <!-- Form keluhan -->
        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('penyewa.keluhan.store') }}" method="POST">
                @csrf

                <label class="block text-sm font-medium mb-2">
                    Ajukan Keluhan
                </label>

                <textarea name="isi_feedback"
                          rows="4"
                          class="w-full border rounded px-3 py-2 mb-4 focus:ring focus:ring-teal-300"
                          placeholder="Tulis keluhan Anda di sini..."
                          required></textarea>

                <button type="submit"
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded font-medium">
                    Kirim Keluhan
                </button>
            </form>
        </div>

    </div>
</div>
@endsection