<x-app-layout>
    @php
    $bookingHref = (auth()->check() ? route('dashboard') : route('dashboard')) . '#kamar';
    @endphp

    <div class="bg-[#f6f3eb] min-h-screen py-8 sm:py-10 md:py-12">
        <div class="mx-auto max-w-6xl sm:max-w-7xl px-4 sm:px-6 lg:px-10">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-stretch">

                {{-- LEFT (DETAIL KAMAR) --}}
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-[24px] shadow-lg p-6 sm:p-8 md:p-10">

                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-800">
                            Detail Kamar Tipe {{ $kamar->tipe_kamar }}
                        </h1>

                        {{-- FOTO --}}
                        <div class="mt-8">
                            <h2 class="text-lg sm:text-2xl font-bold text-gray-800">Foto Kamar</h2>
                            <div class="h-px w-full bg-gray-200 mt-3"></div>

                            <div
                                x-data="{
                                    next() { this.$refs.wrap.scrollBy({ left: 420, behavior: 'smooth' }) },
                                    prev() { this.$refs.wrap.scrollBy({ left: -420, behavior: 'smooth' }) }
                                }"
                                class="mt-6">
                                <div class="relative">

                                    {{-- Arrow kiri --}}
                                    <button type="button"
                                        @click="prev()"
                                        class="hidden sm:flex absolute -left-4 top-1/2 -translate-y-1/2 z-10
                                               h-10 w-10 items-center justify-center rounded-full bg-white shadow
                                               border border-gray-200 hover:bg-gray-50">
                                        ‹
                                    </button>

                                    {{-- Arrow kanan --}}
                                    <button type="button"
                                        @click="next()"
                                        class="hidden sm:flex absolute -right-4 top-1/2 -translate-y-1/2 z-10
                                               h-10 w-10 items-center justify-center rounded-full bg-white shadow
                                               border border-gray-200 hover:bg-gray-50">
                                        ›
                                    </button>

                                    {{-- TRACK FOTO --}}
                                    <div
                                        x-ref="wrap"
                                        class="flex gap-4 overflow-x-auto pb-4 scroll-smooth snap-x snap-mandatory">
                                        @forelse($kamar->fotoDetail as $foto)
                                        <div class="snap-start shrink-0 w-[260px] sm:w-[320px] md:w-[360px]">
                                            <img
                                                src="{{ asset('storage/kamar/' . $foto->foto_path) }}"
                                                class="h-44 sm:h-56 md:h-60 w-full rounded-2xl object-cover shadow"
                                                alt="Foto kamar">
                                        </div>
                                        @empty
                                        <div class="text-gray-500 italic">
                                            Belum ada foto kamar
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- INFO --}}
                        <div class="mt-6 space-y-4 text-gray-700">
                            <p>
                                <span class="font-bold text-gray-900">Deskripsi:</span>
                                {{ $kamar->deskripsi ?? '-' }}
                            </p>
                            <p>
                                <span class="font-bold text-gray-900">Fasilitas:</span>
                                {{ $kamar->fasilitas ?? '-' }}
                            </p>
                        </div>

                        {{-- HARGA --}}
                        <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                            <div class="text-3xl font-extrabold text-blue-600">
                                Rp {{ number_format($kamar->harga_perbulan, 0, ',', '.') }}
                                <span class="text-lg font-bold">/ bulan</span>
                            </div>

                            <a href="{{ $bookingHref }}"
                                class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-10 py-4
                                       font-bold text-white shadow hover:bg-blue-700 transition">
                                Booking Sekarang
                            </a>
                        </div>

                    </div>
                </div>

                {{-- RIGHT (KAMAR KOSONG) --}}
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-[24px] shadow-lg p-6 sm:p-8">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-800">
                            Kamar Kosong Tersedia
                        </h3>

                        <div class="h-px w-full bg-gray-200 mt-3 mb-6"></div>

                        <div class="space-y-3">
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