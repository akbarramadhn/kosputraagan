<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Kos Putra Agan') }}</title>
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

    <nav class="fixed top-0 z-50 w-full bg-teal-800 px-8 py-4 flex justify-between items-center">
        <h1 class="text-white text-xl font-bold">
            Kos Putra Agan
        </h1>

        <div class="flex items-center gap-6">
            <a href="#beranda" class="nav-link">Beranda</a>
            <a href="#kamar" class="nav-link">Kamar</a>
            <a href="#fasilitas" class="nav-link">Fasilitas</a>
            <a href="#kontak" class="nav-link">Kontak</a>

            @auth
                @php
                    $user = auth()->user();
                    $statusPenyewa = optional($user->penyewa)->status; // butuh relasi user->penyewa
                @endphp

                @if($user->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                        Admin Dashboard
                    </a>

                @elseif($user->role === 'penyewa' && $statusPenyewa === 'terverifikasi')
                    <a href="{{ route('penyewa.profil') }}"
                        class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                        Profil
                    </a>

                @else
                    {{-- penyewa menunggu verifikasi (atau status null) -> tombol logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                            Logout
                        </button>
                    </form>
                @endif

            @else
                <a href="{{ route('login') }}"
                    class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                    Login / SignUp
                </a>
            @endauth
        </div>
    </nav>

    <main class="pt-10">
        {{ $slot }}
    </main>

</body>

</html>