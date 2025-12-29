<x-app-layout>
    <div class="bg-[#f6f3eb] py-10">
        <div class="mx-auto max-w-7xl px-6">

            <h1 class="text-4xl font-extrabold text-gray-800 mb-8">
                Detail Kamar Tipe {{ $kamar->tipe_kamar }}
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Foto Kamar</h2>
                        <div class="h-[2px] w-full bg-gray-200 mb-6"></div>

                        {{-- Galeri (ambil dari tabel kamar) --}}
                        <div class="flex gap-6 overflow-x-auto pb-4">
                            @forelse($galeri as $g)
                                <img
                                    src="{{ asset('storage/' . $g->foto_kos) }}"
                                    class="h-56 w-[360px] flex-none rounded-2xl object-cover"
                                    alt="Kamar {{ $g->no_kamar }}"
                                >
                            @empty
                                <div class="h-56 w-full rounded-2xl bg-gray-100 flex items-center justify-center text-gray-500">
                                    Belum ada foto.
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-8 space-y-4">
                            <p class="text-gray-700">
                                <span class="font-bold">Deskripsi:</span>
                                {{ $kamar->deskripsi ?? '-' }}
                            </p>

                            <p class="text-gray-700">
                                <span class="font-bold">Fasilitas:</span>
                                {{ $kamar->fasilitas ?? '-' }}
                            </p>
                        </div>

                        <div class="mt-10 flex items-center justify-between gap-6 flex-wrap">
                            <div class="text-3xl font-extrabold text-blue-600">
                                Rp {{ number_format($kamar->harga_perbulan, 0, ',', '.') }} / bulan
                            </div>

                            <a href="#"
                               class="rounded-xl bg-blue-600 px-7 py-3 font-bold text-white hover:bg-blue-700 transition">
                                Booking Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                {{-- RIGHT --}}
                <div>
                    <div class="bg-white rounded-2xl shadow p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">
                            Kamar Kosong Tersedia
                        </h3>
                        <div class="h-[2px] w-full bg-gray-200 mb-6"></div>

                        <div class="space-y-4">
                            @forelse($kamarKosong as $item)
                                <div class="rounded-xl bg-blue-50 px-5 py-4 font-semibold text-blue-600">
                                    No. Kamar {{ $item->no_kamar }}
                                </div>
                            @empty
                                <div class="rounded-xl bg-red-50 px-5 py-4 font-semibold text-red-600">
                                    Tidak ada kamar tersedia
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>