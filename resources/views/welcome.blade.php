<x-app-layout>
    {{-- HERO --}}
    <section id="beranda" class="relative h-[100vh] bg-cover bg-center"
        style="background-image: url('{{ asset('fotokos/foto1.jpg') }}');">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/50"></div>

        {{-- Content --}}
        <div class="relative z-10 flex h-full flex-col items-center justify-center px-4 text-center text-white">
            <p class="mb-3 text-sm tracking-widest">KOS PUTRA AGAN</p>

            <h1 class="mb-6 text-4xl font-bold md:text-5xl">
                Mencari Kos Yang<br />Nyaman?
            </h1>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="#kamar" class="rounded bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700">
                    Our Rooms
                </a>

                <a href="#about" class="rounded bg-white px-6 py-3 font-semibold text-black hover:bg-gray-200">
                    About Us
                </a>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section id="about" class="bg-[#f6f3eb] py-20">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-14 px-6 lg:grid-cols-2">

            {{-- LEFT CONTENT --}}
            <div>
                <p class="mb-3 font-semibold tracking-widest text-blue-600">
                    ABOUT US
                </p>

                <h2 class="mb-6 text-4xl font-bold leading-snug text-gray-800">
                    Welcome to <br />
                    <span class="text-gray-900">Kos Putra Agan</span>
                </h2>

                <p class="mb-10 leading-relaxed text-gray-600">
                    Selamat Datang di Kos Putra Agan, tempat di mana kenyamanan dan kualitas hidup Anda menjadi
                    prioritas utama kami.
                    Kami menyediakan berbagai pilihan kamar kos yang dirancang khusus untuk memenuhi kebutuhan dan
                    preferensi Anda.
                    Dengan fasilitas modern dan lingkungan yang aman, kami berkomitmen untuk memberikan pengalaman
                    tinggal yang
                    menyenangkan dan memuaskan bagi setiap penghuni kami.
                </p>

                {{-- STAT CARDS --}}
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div class="rounded-xl bg-white p-6 text-center shadow">
                        <div class="mb-3 text-3xl text-blue-600">🏢</div>
                        <h3 class="text-2xl font-bold">{{ $jumlahKamar }}</h3>
                        <p class="text-gray-500">Kamar Kos</p>
                    </div>

                    <div class="rounded-xl bg-white p-6 text-center shadow">
                        <div class="mb-3 text-3xl text-blue-600">🏠</div>
                        <h3 class="text-2xl font-bold">3</h3>
                        <p class="text-gray-500">Tipe Kos</p>
                    </div>

                    <div class="rounded-xl bg-white p-6 text-center shadow">
                        <div class="mb-3 text-3xl text-blue-600">👥</div>
                        <h3 class="text-2xl font-bold">{{ $jumlahPenyewa }}</h3>
                        <p class="text-gray-500">Penghuni</p>
                    </div>
                </div>
            </div>

            {{-- RIGHT IMAGE SLIDER --}}
            <div x-data="{
                    images: @js([
                        asset('foto_info_kos/dapur.jpg'),
                        asset('foto_info_kos/gazebo.jpg'),
                        asset('foto_info_kos/ruangtamu.jpg'),
                        asset('foto_info_kos/parkir.jpg'),
                    ]),
                    index: 0,
                    next() { this.index = (this.index + 1) % this.images.length },
                    prev() { this.index = (this.index - 1 + this.images.length) % this.images.length },
                }" class="relative">
                <img :src="images[index]"
                    class="h-[420px] w-full rounded-2xl object-cover shadow-xl transition-all duration-500"
                    alt="Kos Putra Agan" />

                <button @click="prev"
                    class="absolute left-4 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-black/50 text-white hover:bg-black/70 transition-colors duration-300 ease-in-out">
                    ‹
                </button>

                <button @click="next"
                    class="absolute right-4 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-black/50 text-white hover:bg-black/70">
                    ›
                </button>
            </div>
        </div>
    </section>

    {{-- KAMAR --}}
    <div x-data="bookingUI()" x-cloak>

        <section id="kamar" class="bg-[#f6f3eb] py-20">
            <div class="mx-auto max-w-7xl px-6">

                <div class="mb-16 text-center">
                    <p class="font-bold uppercase tracking-[0.25em] text-blue-600">
                        Our Rooms
                    </p>
                    <h2 class="mt-3 text-4xl font-extrabold sm:text-5xl">
                        Explore Our <span class="text-blue-600">ROOMS</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

                    {{-- ===================== CARD TIPE A ===================== --}}
                    <div class="overflow-hidden rounded-xl bg-white shadow-lg">
                        <div class="relative">
                            <img src="{{ asset('fotokos/foto1.jpg') }}" class="h-56 w-full object-cover" alt="Tipe A">
                            <span
                                class="absolute bottom-4 left-4 rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white">
                                Rp 1.500.000 / Bulan
                            </span>
                        </div>

                        <div class="p-6">
                            <h3 class="mb-3 text-2xl font-bold">Tipe A</h3>

                            <div class="mb-3 flex flex-wrap items-center gap-3 text-sm text-blue-600">
                                <span>🚿 Kamar Mandi Dalam</span>
                                <span>📶 Wifi</span>
                            </div>

                            <p class="mb-4 text-gray-600">
                                Kamar dengan AC dan kamar mandi dalam.
                            </p>

                            @php $a = (int) ($sisa['A'] ?? 0); @endphp
                            <p class="mb-5 font-semibold">
                                Sisa kamar:
                                <span class="{{ $a > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $a }} tersedia
                                </span>
                            </p>

                            <div class="flex gap-3">
                                @if($a > 0)
                                    @auth
                                        <button type="button"
                                            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition"
                                            @click.prevent="openBooking('A', @js($roomsA ?? []))">
                                            Book Now
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition">
                                            Book Now
                                        </a>
                                    @endauth
                                @else
                                    <button type="button" disabled
                                        class="rounded-lg bg-gray-300 px-4 py-2 text-white opacity-60 cursor-not-allowed">
                                        Book Now
                                    </button>
                                @endif

                                <a href="{{ route('kamar.detailTipe', 'A') }}"
                                    class="rounded-lg bg-gray-800 px-4 py-2 text-white hover:bg-gray-900 transition">
                                    View Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- ===================== CARD TIPE B ===================== --}}
                    <div class="overflow-hidden rounded-xl bg-white shadow-lg">
                        <div class="relative">
                            <img src="{{ asset('fotokos/foto2.jpg') }}" class="h-56 w-full object-cover" alt="Tipe B">
                            <span
                                class="absolute bottom-4 left-4 rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white">
                                Rp 1.200.000 / Bulan
                            </span>
                        </div>

                        <div class="p-6">
                            <h3 class="mb-3 text-2xl font-bold">Tipe B</h3>

                            <div class="mb-3 flex flex-wrap items-center gap-3 text-sm text-blue-600">
                                <span>📶 Wifi</span>
                                <span>🪑 Meja Belajar</span>
                                <span>🗄️ Lemari</span>
                            </div>

                            <p class="mb-4 text-gray-600">
                                Kamar bersih dengan akses internet cepat.
                            </p>

                            @php $b = (int) ($sisa['B'] ?? 0); @endphp
                            <p class="mb-5 font-semibold">
                                Sisa kamar:
                                <span class="{{ $b > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $b }} tersedia
                                </span>
                            </p>

                            <div class="flex gap-3">
                                @if($b > 0)
                                    @auth
                                        <button type="button"
                                            class="rounded-lg bg-blue-600 px-6 py-2 text-white shadow hover:bg-blue-700 transition"
                                            @click.prevent="openBooking('B', @js($roomsB ?? []))">
                                            Book Now
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="rounded-lg bg-blue-600 px-6 py-2 text-white shadow hover:bg-blue-700 transition">
                                            Book Now
                                        </a>
                                    @endauth
                                @else
                                    <button type="button" disabled
                                        class="rounded-lg bg-gray-300 px-6 py-2 text-white opacity-60 cursor-not-allowed shadow-none">
                                        Book Now
                                    </button>
                                @endif

                                <a href="{{ route('kamar.detailTipe', 'B') }}"
                                    class="rounded-lg bg-gray-800 px-4 py-2 text-white hover:bg-gray-900 transition">
                                    View Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- ===================== CARD TIPE C ===================== --}}
                    <div class="overflow-hidden rounded-xl bg-white shadow-lg">
                        <div class="relative">
                            <img src="{{ asset('fotokos/foto4.jpg') }}" class="h-56 w-full object-cover" alt="Tipe C">
                            <span
                                class="absolute bottom-4 left-4 rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white">
                                Rp 1.800.000 / Bulan
                            </span>
                        </div>

                        <div class="p-6">
                            <h3 class="mb-3 text-2xl font-bold">Tipe C</h3>

                            <div class="mb-3 flex flex-wrap items-center gap-3 text-sm text-blue-600">
                                <span>📶 Wifi</span>
                                <span>🌀 Kipas Angin</span>
                            </div>

                            <p class="mb-4 text-gray-600">
                                Kamar sederhana untuk mahasiswa.
                            </p>

                            @php $c = (int) ($sisa['C'] ?? 0); @endphp
                            <p class="mb-5 font-semibold">
                                Sisa kamar:
                                <span class="{{ $c > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $c }} tersedia
                                </span>
                            </p>

                            <div class="flex gap-3">
                                @if($c > 0)
                                    @auth
                                        <button type="button"
                                            class="rounded-lg bg-blue-600 px-6 py-2 text-white shadow hover:bg-blue-700 transition"
                                            @click.prevent="openBooking('C', @js($roomsC ?? []))">
                                            Book Now
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="rounded-lg bg-blue-600 px-6 py-2 text-white shadow hover:bg-blue-700 transition">
                                            Book Now
                                        </a>
                                    @endauth
                                @else
                                    <button type="button" disabled
                                        class="rounded-lg bg-gray-300 px-6 py-2 text-white opacity-60 cursor-not-allowed shadow-none">
                                        Book Now
                                    </button>
                                @endif

                                <a href="{{ route('kamar.detailTipe', 'C') }}"
                                    class="rounded-lg bg-gray-800 px-4 py-2 text-white hover:bg-gray-900 transition">
                                    View Detail
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ===================== MODAL BOOKING (HANYA UNTUK USER LOGIN) ===================== --}}
        @auth
            <!-- overlay -->
            <div x-show="open" x-transition.opacity class="fixed inset-0 z-40 bg-black/60" @click="closeModal()"></div>

            <!-- modal wrapper -->
            <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4"
                @keydown.escape.window="closeModal()">

                <!-- card -->
                <div class="w-full max-w-3xl rounded-2xl bg-white p-8 shadow-2xl" @click.stop>

                    <!-- header -->
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-slate-800">Booking</h2>

                        <button type="button" class="text-2xl text-slate-500 hover:text-slate-700" @click="closeModal()"
                            aria-label="Close">
                            ×
                        </button>
                    </div>

                    <form class="space-y-5" method="POST" action="{{ route('booking.store') }}">
                        @csrf

                        <!-- Tipe kamar -->
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-800">Tipe Kamar:</label>
                            <input type="text" name="tipe_kamar" x-model="form.tipe" readonly
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-800 focus:outline-none" />
                        </div>

                        <!-- No kamar -->
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-800">No Kamar:</label>
                            <select name="no_kamar" x-model="form.no_kamar" required
                                class="w-full rounded-lg border border-slate-200 px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#006a71]/30">
                                <option value="">-- Pilih No Kamar --</option>
                                <template x-for="r in rooms" :key="r">
                                    <option :value="r" x-text="r"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Tanggal mulai -->
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-800">Tanggal Mulai:</label>
                            <div class="relative">
                                <input type="date" name="tanggal_mulai" x-model="form.mulai" required
                                    class="w-full rounded-lg border border-slate-200 px-4 py-3 pr-10 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#006a71]/30" />
                                <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-500"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                    <path d="M16 2v4M8 2v4M3 10h18"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Tanggal selesai -->
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-800">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" x-model="form.selesai" required
                                class="w-full rounded-lg border border-slate-200 px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#006a71]/30" />
                        </div>

                        <!-- button -->
                        <div class="pt-2">
                            <button type="submit"
                                class="rounded-lg bg-blue-600 px-8 py-3 text-white shadow hover:bg-blue-700 transition">
                                Submit Booking
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        @endauth
    </div>


    {{-- ===================== ALPINE SCRIPT ===================== --}}
    <script>
        function bookingUI() {
            return {
                open: false,
                rooms: [],
                form: { tipe: '', no_kamar: '', mulai: '', selesai: '' },

                openBooking(tipe, roomList) {
                    console.log('tipe:', tipe)
                    console.log('roomList:', roomList)

                    this.open = true
                    this.form.tipe = tipe
                    this.rooms = Array.isArray(roomList) ? roomList : []

                    // reset pilihan biar dropdown fresh
                    this.form.no_kamar = ''
                    this.form.mulai = ''
                    this.form.selesai = ''

                    document.documentElement.classList.add('overflow-hidden')
                },

                closeModal() {
                    this.open = false
                    document.documentElement.classList.remove('overflow-hidden')
                },
            }
        }
    </script>

    {{-- LOCATION --}}
    <section class="bg-[#f6f1e9] py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="relative overflow-hidden rounded-3xl">
                <div class="absolute inset-0 bg-gradient-to-r from-black via-black to-black/80"></div>

                <div class="relative grid min-h-[420px] grid-cols-1 items-center px-10 py-14 lg:grid-cols-2 lg:px-14">
                    <div class="text-white">
                        <p class="mb-3 font-semibold tracking-widest text-blue-500">
                            OUR LOCATION
                        </p>

                        <h2 class="mb-4 text-4xl font-bold">
                            Find Us!
                        </h2>

                        <p class="mb-4 text-gray-300">
                            Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                        </p>

                        <p class="text-gray-300">
                            Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit,
                            sed stet lorem sit clita duo justo magna dolore erat amet.
                        </p>
                    </div>

                    <div class="h-[320px] w-full overflow-hidden rounded-2xl lg:h-[350px]">
                        <iframe class="h-full w-full border-0" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.3782500041752!2d106.82499527428435!3d-6.345038162076593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69edb8ae8cfbdd%3A0x2ec23e3fed4355e5!2sKost%20Putra%20Agan!5e0!3m2!1sid!2sid!4v1748594515946!5m2!1sid!2sid">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICES / FASILITAS --}}
    <section id="fasilitas" class="bg-[#f6f3eb] py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-14 text-center">
                <p class="font-bold uppercase tracking-[0.25em] text-blue-600">
                    Our Services
                </p>
                <h2 class="mt-3 text-4xl font-extrabold sm:text-5xl">
                    Explore Our <span class="text-blue-600">SERVICES</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                {{-- Card 1 --}}
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border-2 border-blue-600">
                        <svg class="h-9 w-9 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17a2 2 0 104 0m-4 0H7a2 2 0 100 4h10a2 2 0 100-4h-2m-6 0h6M5 13l1-4a2 2 0 012-2h8a2 2 0 012 2l1 4M6 13h12" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-center text-xl font-extrabold">Parkiran</h3>
                    <p class="mt-3 text-center text-gray-600">Tempat parkir yang luas</p>
                </div>

                {{-- Card 2 --}}
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border-2 border-blue-600">
                        <svg class="h-9 w-9 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.111 16.404a5 5 0 017.778 0M5.5 13.5a9 9 0 0113 0M2.5 10.5a13 13 0 0119 0M12 19h.01" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-center text-xl font-extrabold">WiFi Cepat</h3>
                    <p class="mt-3 text-center text-gray-600">Tersedia WiFi dengan kecepatan tinggi 24 jam</p>
                </div>

                {{-- Card 3 --}}
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border-2 border-blue-600">
                        <svg class="h-9 w-9 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 3v8a2 2 0 01-2 2H5m3-10v8m0 0h4m0 0V3m5 0v10a2 2 0 01-2 2h-1m3-12v6m0 0h-2" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-center text-xl font-extrabold">Warung Makan</h3>
                    <p class="mt-3 text-center text-gray-600">Tersedia warung makan di kos</p>
                </div>

                {{-- Card 4 --}}
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border-2 border-blue-600">
                        <svg class="h-9 w-9 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12a2 2 0 012-2h10a2 2 0 012 2v6H5v-6zM7 10V8a2 2 0 012-2h6a2 2 0 012 2v2" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-center text-xl font-extrabold">Ruang Tamu</h3>
                    <p class="mt-3 text-center text-gray-600">
                        Tersedia ruang tamu untuk menerima tamu atau bersantai bersama
                    </p>
                </div>

                {{-- Card 5 --}}
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border-2 border-blue-600">
                        <svg class="h-9 w-9 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 2l3 6h-2l3 6h-3l3 6H10l3-6H10l3-6H11l1-6z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-center text-xl font-extrabold">Gazebo Santai</h3>
                    <p class="mt-3 text-center text-gray-600">
                        Area gazebo untuk tempat kumpul dan bersantai bersama penghuni kos
                    </p>
                </div>

                {{-- Card 6 --}}
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border-2 border-blue-600">
                        <svg class="h-9 w-9 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9l1-5h16l1 5M5 9v11h14V9M9 20v-7h6v7" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-center text-xl font-extrabold">Dapur Umum</h3>
                    <p class="mt-3 text-center text-gray-600">
                        Dapur bersama yang bisa digunakan untuk memasak ringan
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- OUR TEAM --}}
    <section id="kontak" class="bg-[#f6f3eb] py-20">
        <div class="mx-auto max-w-7xl px-6">

            {{-- TITLE --}}
            <div class="mb-16 text-center">
                <p class="font-bold uppercase tracking-[0.25em] text-blue-600">
                    Our Team
                </p>
                <h2 class="mt-3 text-4xl font-extrabold sm:text-5xl">
                    Explore Our <span class="text-blue-600">STAFFS</span>
                </h2>
            </div>

            {{-- TEAM GRID --}}
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

                {{-- STAFF 1 --}}
                <div class="overflow-hidden rounded-2xl bg-white shadow-lg transition hover:-translate-y-2">
                    <div class="relative h-72 bg-[#cfd6e6] flex items-end justify-center">
                        {{-- avatar placeholder --}}
                        <img src="{{ asset('adminkos/akbar.jpeg') }}" class="absolute top-0 h-full w-full object-cover"
                            alt="M Akbar Ramadhan">

                        {{-- WhatsApp --}}
                        <a href="https://wa.me/6283196390884" target="_blank"
                            class="absolute bottom-6 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.04 2C6.58 2 2.04 6.48 2.04 12c0 1.98.58 3.82 1.58 5.38L2 22l4.8-1.56A9.93 9.93 0 0012.04 22c5.46 0 9.96-4.48 9.96-10S17.5 2 12.04 2z" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold">M Akbar Ramadhan</h3>
                        <p class="text-gray-500">Admin</p>
                    </div>
                </div>

                {{-- STAFF 2 --}}
                <div class="overflow-hidden rounded-2xl bg-white shadow-lg transition hover:-translate-y-2">
                    <div class="relative h-72 bg-[#cfd6e6] flex items-end justify-center">
                        <img src="{{ asset('adminkos/hany.jpeg') }}" class="absolute top-0 h-full w-full object-cover"
                            alt="Hany Nadya Fairuz">
                        <a href="https://wa.me/6281386382210" target="_blank"
                            class="absolute bottom-6 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.04 2C6.58 2 2.04 6.48 2.04 12c0 1.98.58 3.82 1.58 5.38L2 22l4.8-1.56A9.93 9.93 0 0012.04 22c5.46 0 9.96-4.48 9.96-10S17.5 2 12.04 2z" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold">Hany Nadya Fairuz</h3>
                        <p class="text-gray-500">Admin</p>
                    </div>
                </div>

                {{-- STAFF 3 --}}
                <div class="overflow-hidden rounded-2xl bg-white shadow-lg transition hover:-translate-y-2">
                    <div class="relative h-72 bg-[#cfd6e6] flex items-end justify-center">
                        <img src="{{ asset('adminkos/bilqis.jpeg') }}" class="absolute top-0 h-full w-full object-cover"
                            alt="Bilqis Muflihunnisa">
                        <a href="https://wa.me/6281511135664" target="_blank"
                            class="absolute bottom-6 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.04 2C6.58 2 2.04 6.48 2.04 12c0 1.98.58 3.82 1.58 5.38L2 22l4.8-1.56A9.93 9.93 0 0012.04 22c5.46 0 9.96-4.48 9.96-10S17.5 2 12.04 2z" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold">Bilqis Muflihunnisa</h3>
                        <p class="text-gray-500">Admin</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <footer id="kontak" class="bg-[#1f1f1f] text-gray-300 pt-20">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-14 pb-16 text-center">

                {{-- BRAND --}}
                <div class="flex flex-col items-center">
                    <h2 class="text-white text-4xl font-extrabold mb-6">
                        Kos Putra Agan
                    </h2>

                    <p class="text-gray-400 leading-relaxed max-w-md">
                        Tempat tinggal nyaman dan strategis untuk mahasiswa dan pekerja.
                        Dilengkapi fasilitas lengkap dan lingkungan aman.
                    </p>
                </div>

                {{-- MENU --}}
                <div class="flex flex-col items-center">
                    <h3 class="text-white text-2xl font-bold mb-6">
                        Menu
                    </h3>

                    <ul class="space-y-4">
                        <li>
                            <a href="#beranda" class="hover:text-white transition">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#kamar" class="hover:text-white transition">
                                Kamar
                            </a>
                        </li>
                        <li>
                            <a href="#fasilitas" class="hover:text-white transition">
                                Fasilitas
                            </a>
                        </li>
                        <li>
                            <a href="#kontak" class="hover:text-white transition">
                                Kontak
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- CONTACT --}}
                <div class="flex flex-col items-center">
                    <h3 class="text-white text-2xl font-bold mb-6">
                        Hubungi Kami
                    </h3>

                    <ul class="space-y-4">
                        <li class="flex items-center justify-center gap-4">
                            <span class="text-blue-500 text-xl">📞</span>
                            <span>0812-3456-7890</span>
                        </li>

                        <li class="flex items-center justify-center gap-4">
                            <span class="text-blue-500 text-xl">✉️</span>
                            <span>info@kosagan.com</span>
                        </li>
                    </ul>

                    {{-- SOCIAL --}}
                    <div class="flex justify-center gap-6 mt-6">
                        <a href="#" class="text-blue-500 text-xl hover:scale-110 transition">📘</a>
                        <a href="#" class="text-blue-500 text-xl hover:scale-110 transition">📷</a>
                        <a href="#" class="text-blue-500 text-xl hover:scale-110 transition">💬</a>
                    </div>
                </div>

            </div>

            {{-- DIVIDER --}}
            <div class="border-t border-white/10"></div>

            {{-- COPYRIGHT --}}
            <div class="py-6 text-center text-gray-400 text-sm">
                © {{ date('Y') }} Kos Putra Agan. All rights reserved.
            </div>

        </div>
    </footer>
</x-app-layout>