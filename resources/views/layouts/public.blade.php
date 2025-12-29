<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kos Putra Agan') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        section { scroll-margin-top: 90px; }
        [x-cloak]{display:none!important}
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">

    <nav class="fixed top-0 z-50 w-full bg-teal-800 px-8 py-4 flex justify-between items-center">
        <h1 class="text-white text-xl font-bold">Kos Putra Agan</h1>

        <div class="flex items-center gap-6">
            <a href="/#beranda" class="text-white/90 hover:text-white">Beranda</a>
            <a href="/#kamar" class="text-white/90 hover:text-white">Kamar</a>
            <a href="/#fasilitas" class="text-white/90 hover:text-white">Fasilitas</a>
            <a href="/#kontak" class="text-white/90 hover:text-white">Kontak</a>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                    Login / SignUp
                </a>
            @endauth
        </div>
    </nav>

    <main class="pt-[72px] bg-[#f6f3eb]">
        {{ $slot }}
    </main>

</body>
</html>