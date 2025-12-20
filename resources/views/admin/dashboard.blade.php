<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard Admin</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
        <div class="bg-white p-4 shadow rounded">Total Kamar: {{ $totalKamar }}</div>
        <div class="bg-white p-4 shadow rounded">Kamar Kosong: {{ $kamarKosong }}</div>
        <div class="bg-white p-4 shadow rounded">Penyewa Aktif: {{ $penyewaAktif }}</div>
        <div class="bg-white p-4 shadow rounded">Feedback Baru: {{ $feedbackBaru }}</div>
        <div class="bg-white p-4 shadow rounded">Pembayaran Pending: {{ $pembayaranPending }}</div>
    </div>
</x-app-layout>