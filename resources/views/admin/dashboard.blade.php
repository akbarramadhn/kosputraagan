<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl md:text-2xl text-gray-800">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 sm:gap-6">
            
            <div class="bg-white p-4 sm:p-5 md:p-6 shadow rounded-xl text-center sm:text-left">
                <p class="text-gray-600 text-sm sm:text-base">Total Kamar</p>
                <p class="text-xl sm:text-2xl font-bold text-teal-600 mt-1">{{ $totalKamar }}</p>
            </div>

            <div class="bg-white p-4 sm:p-5 md:p-6 shadow rounded-xl text-center sm:text-left">
                <p class="text-gray-600 text-sm sm:text-base">Kamar Kosong</p>
                <p class="text-xl sm:text-2xl font-bold text-teal-600 mt-1">{{ $kamarKosong }}</p>
            </div>

            <div class="bg-white p-4 sm:p-5 md:p-6 shadow rounded-xl text-center sm:text-left">
                <p class="text-gray-600 text-sm sm:text-base">Penyewa Aktif</p>
                <p class="text-xl sm:text-2xl font-bold text-teal-600 mt-1">{{ $penyewaAktif }}</p>
            </div>

            <div class="bg-white p-4 sm:p-5 md:p-6 shadow rounded-xl text-center sm:text-left">
                <p class="text-gray-600 text-sm sm:text-base">Feedback Baru</p>
                <p class="text-xl sm:text-2xl font-bold text-teal-600 mt-1">{{ $feedbackBaru }}</p>
            </div>

            <div class="bg-white p-4 sm:p-5 md:p-6 shadow rounded-xl text-center sm:text-left">
                <p class="text-gray-600 text-sm sm:text-base">Pembayaran Pending</p>
                <p class="text-xl sm:text-2xl font-bold text-teal-600 mt-1">{{ $pembayaranPending }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
