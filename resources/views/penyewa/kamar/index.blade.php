<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Kamar Tersedia
        </h2>
    </x-slot>

    <div class="p-6 grid grid-cols-3 gap-4">
        @foreach ($kamars as $kamar)
            <div class="bg-white p-4 rounded shadow">
                <p>No Kamar: {{ $kamar->no_kamar }}</p>
                <p>Harga: Rp {{ number_format($kamar->harga_perbulan, 0, ',', '.') }}</p>

                <form method="POST" action="{{ route('penyewa.sewa.store', $kamar->no_kamar) }}">
                    @csrf
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">
                        Sewa
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>