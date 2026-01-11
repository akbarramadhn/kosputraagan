<x-app-layout>
    @php
        // Tombol booking: login -> dashboard#kamar, guest -> home#kamar
        $bookingHref = (auth()->check() ? route('dashboard') : route('dashboard')) . '#kamar';
    @endphp

    <div class="bg-[#f6f3eb] py-10">
        <div class="mx-auto max-w-7xl px-6">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- LEFT (CARD BESAR) --}}
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-[28px] shadow-lg p-8 sm:p-10">

                        <h1 class="text-4xl font-extrabold text-gray-800">
                            Detail Kamar Tipe {{ $kamar->tipe_kamar }}
                        </h1>

                        <div class="mt-10">
                            <h2 class="text-2xl font-bold text-gray-800">Foto Kamar</h2>
                            <div class="h-px w-full bg-gray-200 mt-3"></div>

                            {{-- Galeri --}}
                            <div
                                x-data="{
                                    next() { this.$refs.wrap.scrollBy({ left: 420, behavior: 'smooth' }) },
                                    prev() { this.$refs.wrap.scrollBy({ left: -420, behavior: 'smooth' }) },
                                }"
                                class="mt-6"
                            >
                                <div class="relative">
                                    {{-- Arrow kiri --}}
                                    <button type="button"
                                        @click="prev()"
                                        class="hidden sm:flex absolute -left-4 top-1/2 -translate-y-1/2 z-10
                                               h-10 w-10 items-center justify-center rounded-full bg-white shadow
                                               border border-gray-200 hover:bg-gray-50">
                                        <span class="text-gray-700 text-xl">‹</span>
                                    </button>

                                    {{-- Arrow kanan --}}
                                    <button type="button"
                                        @click="next()"
                                        class="hidden sm:flex absolute -right-4 top-1/2 -translate-y-1/2 z-10
                                               h-10 w-10 items-center justify-center rounded-full bg-white shadow
                                               border border-gray-200 hover:bg-gray-50">
                                        <span class="text-gray-700 text-xl">›</span>
                                    </button>

                                    {{-- Track foto --}}
                                    <div x-ref="wrap"
                                        class="flex gap-6 overflow-x-auto pb-4 scroll-smooth snap-x snap-mandatory"
                                        style="scrollbar-color:#8b8b8b transparent; scrollbar-width:thin;"
                                    >
                                        @forelse($galeri as $g)
                                            <div class="snap-start shrink-0 w-[320px] sm:w-[360px]">
                                                <img
                                                    src="{{ asset('foto_detail_kamar/' . $g->foto_kos) }}"
                                                    class="h-56 sm:h-60 w-full rounded-2xl object-cover shadow"
                                                    alt="Kamar {{ $g->no_kamar }}"
                                                >
                                            </div>
                                        @empty
                                            <div class="h-56 w-full rounded-2xl bg-gray-100 flex items-center justify-center text-gray-500">
                                                Belum ada foto.
                                            </div>
                                        @endforelse
                                    </div>

                                    {{-- Bar scroll ala gambar --}}
                                    <div class="mt-2 h-2 w-full rounded-full bg-gray-200 overflow-hidden">
                                        <div class="h-full w-1/2 rounded-full bg-gray-500/70"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="mt-8 space-y-5 text-gray-700">
                                <p>
                                    <span class="font-bold text-gray-900">Deskripsi:</span>
                                    {{ $kamar->deskripsi ?? '-' }}
                                </p>

                                <p>
                                    <span class="font-bold text-gray-900">Fasilitas:</span>
                                    {{ $kamar->fasilitas ?? '-' }}
                                </p>
                            </div>

                            {{-- Harga + tombol --}}
                            <div class="mt-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                                <div class="text-3xl font-extrabold text-blue-600">
                                    Rp {{ number_format($kamar->harga_perbulan, 0, ',', '.') }}
                                    <span class="text-xl font-bold">/ bulan</span>
                                </div>

                                <a href="{{ $bookingHref }}"
                                    class="inline-flex items-center justify-center rounded-2xl
                                           bg-blue-600 px-10 py-4 font-bold text-white shadow-lg
                                           hover:bg-blue-700 active:scale-[0.99] transition">
                                    Booking Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT (CARD KECIL) --}}
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-[22px] shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-800">
                            Kamar Kosong Tersedia
                        </h3>
                        <div class="h-px w-full bg-gray-200 mt-3 mb-6"></div>

                        {{-- versi list (kayak kamu) --}}
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