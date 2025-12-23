<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Kos Putra Agan') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind dari Breeze --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- Navbar --}}
    <nav class="bg-teal-700 px-8 py-4 flex justify-between items-center">
        <h1 class="text-white text-xl font-bold">
            Kos Putra Agan
        </h1>

        <div class="flex items-center gap-6">
            <a href="#" class="text-white hover:underline">Beranda</a>
            <a href="#" class="text-white hover:underline">Kamar</a>
            <a href="#" class="text-white hover:underline">Fasilitas</a>
            <a href="#" class="text-white hover:underline">Kontak</a>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="bg-yellow-400 px-4 py-2 rounded font-semibold">
                   Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="bg-yellow-400 px-4 py-2 rounded font-semibold">
                   Login / SignUp
                </a>
            @endauth
        </div>
    </nav>

    {{-- Content --}}
    <main>
        {{ $slot }}
    </main>

</body>
</html>