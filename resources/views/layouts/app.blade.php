<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kos Putra Agan - Kos Nyaman Sejagakarsa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 90px;
        }

        .nav-link {
            position: relative;
            color: white;
            font-weight: 500;
            padding: 6px 2px;
            transition: opacity .2s ease;
        }

        .nav-link:hover {
            opacity: .9;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 100%;
            background: white;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .25s ease;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }
    </style>
</head>

<body class="font-sans antialiased">
    @php
        $showAkunSaya = false;
        $akunSayaHref = null;

        if (auth()->check()) {
            $user = auth()->user();

            if (strtolower(trim($user->role ?? '')) === 'penyewa') {
                $penyewa = $user->penyewa;

                if ($penyewa) {
                    // ✅ Kalau sudah terverifikasi: Akun Saya -> Profil
                    if (($penyewa->status ?? null) === 'Terverifikasi') {
                        $showAkunSaya = true;
                        $akunSayaHref = route('penyewa.profil');
                    } else {
                        // ✅ Kalau belum terverifikasi: Akun Saya hanya muncul jika sudah pernah bayar -> Status
                        $hasPayment = \App\Models\Pembayaran::join('sewa', 'pembayaran.id_sewa', '=', 'sewa.id_sewa')
                            ->where('sewa.id_penyewa', $penyewa->id_penyewa)
                            ->exists();

                        if ($hasPayment) {
                            $showAkunSaya = true;
                            $akunSayaHref = route('penyewa.status');
                        }
                    }
                }
            }
        }
    @endphp

    {{-- ===================== NAVBAR RESPONSIVE ===================== --}}
    <nav x-data="{ open: false }"
        class="fixed top-0 z-50 w-full bg-teal-800 px-4 sm:px-8 py-4 flex items-center justify-between">

        {{-- Brand --}}
        <h1 class="text-white text-xl font-bold">
            Kos Putra Agan
        </h1>

        {{-- Desktop Menu --}}
        <div class="hidden md:flex items-center gap-6">
            @php $home = url('/'); @endphp
            <a href="{{ $home }}#beranda" class="nav-link">Beranda</a>
            <a href="{{ $home }}#kamar" class="nav-link">Kamar</a>
            <a href="{{ $home }}#fasilitas" class="nav-link">Fasilitas</a>
            <a href="{{ $home }}#kontak" class="nav-link">Kontak</a>


            @auth
                {{-- ADMIN --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                        Admin Dashboard
                    </a>
                @endif

                {{-- PENYEWA --}}
                @if($showAkunSaya)
                    <a href="{{ $akunSayaHref }}" class="nav-link">
                        Akun Saya
                    </a>
                @endif

                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                    Login / SignUp
                </a>
            @endauth
        </div>

        {{-- Mobile Hamburger --}}
        <button type="button"
            class="md:hidden inline-flex items-center justify-center rounded-lg p-2 text-white hover:bg-white/10 transition"
            @click="open = !open" :aria-expanded="open.toString()" aria-label="Toggle menu">
            {{-- icon --}}
            <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Mobile Overlay --}}
        <div x-show="open" x-cloak x-transition.opacity class="fixed inset-0 z-40 bg-black/50 md:hidden"
            @click="open = false" @keydown.escape.window="open = false"></div>

        {{-- Mobile Panel --}}
        <div x-show="open" x-cloak x-transition
            class="absolute left-0 right-0 top-full z-50 md:hidden bg-teal-800 border-t border-white/15">
            <div class="px-4 py-4 flex flex-col gap-3">

                @php $home = url('/'); @endphp

                <a href="{{ $home }}#beranda" class="nav-link">Beranda</a>
                <a href="{{ $home }}#kamar" class="nav-link">Kamar</a>
                <a href="{{ $home }}#fasilitas" class="nav-link">Fasilitas</a>
                <a href="{{ $home }}#kontak" class="nav-link">Kontak</a>

                <div class="h-px bg-white/15 my-2"></div>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition w-fit"
                            @click="open = false">
                            Admin Dashboard
                        </a>
                    @endif

                    @if($showAkunSaya)
                        <a href="{{ $akunSayaHref }}" class="nav-link" @click="open = false">
                            Akun Saya
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition w-fit">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition w-fit"
                        @click="open = false">
                        Login / SignUp
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-10">
        {{ $slot }}
    </main>

</body>

</html>