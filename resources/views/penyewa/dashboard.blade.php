<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard Penyewa</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <div class="bg-white p-4 shadow rounded">
            <strong>Status Akun:</strong> {{ $penyewa->status_akun }}
        </div>

        @if($sewaAktif)
            <div class="bg-white p-4 shadow rounded">
                <p><strong>Kamar:</strong> {{ $sewaAktif->kamar->no_kamar }}</p>
                <p><strong>Status Sewa:</strong> {{ $sewaAktif->status_sewa }}</p>
                <p><strong>Selesai:</strong> {{ $sewaAktif->tanggal_selesai }}</p>
            </div>

            @if($pembayaranTerakhir)
                <div class="bg-white p-4 shadow rounded">
                    <strong>Pembayaran Terakhir:</strong>
                    Rp {{ number_format($pembayaranTerakhir->jumlah_bayar,0,',','.') }}
                </div>
            @endif
        @else
            <div class="bg-yellow-100 p-4 rounded">
                Kamu belum memiliki sewa aktif.
            </div>
        @endif
    </div>
</x-app-layout>