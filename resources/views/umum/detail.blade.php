<x-app-layout>
    @php
        $bookingHref = (auth()->check() ? route('dashboard') : route('dashboard')) . '#kamar';
    @endphp

    <div class="bg-[#f6f3eb] py-8 sm:py-10 md:py-12">
        <div class="mx-auto max-w-6xl sm:max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">

                {{-- LEFT (CARD BESAR) --}}
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-[24px] sm:rounded-[28px] shadow-lg p-5 sm:p-8 md:p-10">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-800 text-center sm:text-left">
                            Detail Kamar Tipe {{ $kamar->tipe_kamar }}
                        </h1>

                        <div class="mt-8 sm:mt-10">
                            <h2 class="text-lg sm:text-2xl font-bold text-gray-800">Foto Kamar</h2>
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
                                        class="hidden sm:flex absolute -left-3 md:-left-4 top-1/2 -translate-y-1/2 z-10
                                               h-8 sm:h-10 w-8 sm:w-10 items-center justify-center rounded-full bg-white shadow
                                               border border-gray-200 hover:bg-gray-50">
                                        <span class="text-gray-700 text-lg sm:text-xl">‹</span>
                                    </button>

                                    {{-- Arrow kanan --}}
                                    <button type="button"
                                        @click="next()"
                                        class="hidden sm:flex absolute -right-3 md:-right-4 top-1/2 -translate-y-1/2 z-10
                                               h-8 sm:h-10 w-8 sm:w-10 items-center justify-center rounded-full bg-white shadow
                                               border border-gray-200 hover:bg-gray-50">
                                        <span class="text-gray-700 text-lg sm:text-xl">›</span>
                                    </button>

                                    {{-- Track foto --}}
                                    <div x-ref="wrap"
                                        class="flex gap-4 sm:gap-6 overflow-x-auto pb-3 sm:pb-4 scroll-smooth snap-x snap-mandatory"
                                        style="scrollbar-color:#8b8b8b transparent; scrollbar-width:thin;">
                                        @forelse($galeri as $g)
                                            <div class="snap-start shrink-0 w-[250px] sm:w-[320px] md:w-[360px]">
                                                <img
                                                    src="{{ asset('foto_detail_kamar/' . $g->foto_kos) }}"
                                                    class="h-44 sm:h-56 md:h-60 w-full rounded-2xl object-cover shadow"
                                                    alt="Kamar {{ $g->no_kamar }}"
                                                >
                                            </div>
                                        @empty
                                            <div class="h-44 sm:h-56 w-full rounded-2xl bg-gray-100 flex items-center justify-center text-gray-500">
                                                Belum ada foto.
                                            </div>
                                        @endforelse
                                    </div>

                                    {{-- Bar scroll --}}
                                    <div class="mt-2 h-2 w-full rounded-full bg-gray-200 overflow-hidden">
                                        <div class="h-full w-1/2 rounded-full bg-gray-500/70"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="mt-6 sm:mt-8 space-y-4 sm:space-y-5 text-gray-700 text-sm sm:text-base">
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
                            <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 sm:gap-6">
                                <div class="text-2xl sm:text-3xl font-extrabold text-blue-600 text-center sm:text-left">
                                    Rp {{ number_format($kamar->harga_perbulan, 0, ',', '.') }}
                                    <span class="text-lg sm:text-xl font-bold">/ bulan</span>
                                </div>

                                <a href="{{ $bookingHref }}"
                                    class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-8 sm:px-10 py-3 sm:py-4
                                           font-bold text-white shadow-lg hover:bg-blue-700 active:scale-[0.99] transition text-sm sm:text-base">
                                    Booking Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT (CARD KECIL) --}}
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-[18px] sm:rounded-[22px] shadow-lg p-6 sm:p-8">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-800 text-center sm:text-left">
                            Kamar Kosong Tersedia
                        </h3>
                        <div class="h-px w-full bg-gray-200 mt-3 mb-6"></div>

                        {{-- List kamar --}}
                        <div class="space-y-3 sm:space-y-4">
                            @forelse($kamarKosong as $item)
                                <div class="rounded-xl bg-blue-50 px-4 sm:px-5 py-3 sm:py-4 font-semibold text-blue-600 text-center sm:text-left">
                                    No. Kamar {{ $item->no_kamar }}
                                </div>
                            @empty
                                <div class="rounded-xl bg-red-50 px-4 sm:px-5 py-3 sm:py-4 font-semibold text-red-600 text-center sm:text-left">
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
