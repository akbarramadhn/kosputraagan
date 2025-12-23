<x-app-layout>
    <section class="relative h-[90vh] bg-cover bg-center"
        style="background-image: url('{{ asset('images/foto1.jpg') }}');">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/50"></div>

        {{-- Content --}}
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
            <p class="tracking-widest text-sm mb-3">KOS PUTRA AGAN</p>

            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                Mencari Kos Yang<br>Nyaman?
            </h1>

            <div class="flex gap-4">
                <a href="#kamar" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded text-white font-semibold">
                    Our Rooms
                </a>

                <a href="#about" class="bg-white text-black hover:bg-gray-200 px-6 py-3 rounded font-semibold">
                    About Us
                </a>
            </div>
        </div>
    </section>
    <section id="about" class="bg-[#f6f3eb] py-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            {{-- LEFT CONTENT --}}
            <div>
                <p class="text-blue-600 font-semibold tracking-widest mb-3">
                    ABOUT US
                </p>

                <h2 class="text-4xl font-bold text-gray-800 mb-6 leading-snug">
                    Welcome to <br>
                    <span class="text-gray-900">Kos Putra Agan</span>
                </h2>

                <p class="text-gray-600 mb-10 leading-relaxed">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                    Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit,
                    sed stet lorem sit clita duo justo magna dolore erat amet.
                </p>

                {{-- STAT CARDS --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow p-6 text-center">
                        <div class="text-blue-600 text-3xl mb-3">🏢</div>
                        <h3 class="text-2xl font-bold">2</h3>
                        <p class="text-gray-500">Kamar Kos</p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-6 text-center">
                        <div class="text-blue-600 text-3xl mb-3">🏠</div>
                        <h3 class="text-2xl font-bold">3</h3>
                        <p class="text-gray-500">Tipe Kos</p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-6 text-center">
                        <div class="text-blue-600 text-3xl mb-3">👥</div>
                        <h3 class="text-2xl font-bold">2</h3>
                        <p class="text-gray-500">Penghuni (Saat Ini)</p>
                    </div>
                </div>
            </div>

            {{-- RIGHT IMAGE SLIDER --}}
            <div x-data="{
        images: [
            '{{ asset('images/foto1.jpg') }}',
            '{{ asset('images/foto2.jpg') }}',
            '{{ asset('images/foto4.jpg') }}',
            '{{ asset('images/foto5.jpg') }}'
        ],
        index: 0,
        next() {
            this.index = (this.index + 1) % this.images.length
        },
        prev() {
            this.index = (this.index - 1 + this.images.length) % this.images.length
        }
    }" class="relative">

                {{-- IMAGE --}}
                <img :src="images[index]"
                    class="rounded-2xl shadow-xl w-full h-[420px] object-cover transition-all duration-500"
                    alt="Kos Putra Agan">

                {{-- PREV BUTTON --}}
                <button @click="prev"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-12 h-12 rounded-full flex items-center justify-center">
                    ‹
                </button>

                {{-- NEXT BUTTON --}}
                <button @click="next"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-12 h-12 rounded-full flex items-center justify-center">
                    ›
                </button>

            </div>
        </div>
    </section>
</x-app-layout>