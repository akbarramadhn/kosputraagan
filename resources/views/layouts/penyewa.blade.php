<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel Penyewa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-[#f5f2ea]">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="w-64 bg-teal-900 text-white transition-all duration-300">

        {{-- LOGO --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-teal-700">
            <span class="text-xl font-bold">Penyewa</span>
            <button id="closeSidebar" class="md:hidden text-2xl">✕</button>
        </div>

        {{-- MENU --}}
        <nav class="mt-6 space-y-1 px-3 text-sm">

            <x-penyewa-link route="penyewa.profil" icon="fa-solid fa-user">
                Profile
            </x-penyewa-link>

            <x-penyewa-link route="penyewa.perpanjang.index" icon="fa-solid fa-clock-rotate-left">
                Perpanjang Kos
            </x-penyewa-link>

            <x-penyewa-link route="penyewa.keluhan.index" icon="fa-solid fa-comment-dots">
                Ajukan Keluhan
            </x-penyewa-link>

            <x-penyewa-logout icon="fas fa-sign-out-alt">
                Logout
            </x-penyewa-logout>

        </nav>
    </aside>

    {{-- CONTENT --}}
    <div class="flex-1">

        {{-- NAVBAR --}}
        <header class="bg-white shadow px-6 py-4 flex items-center">
            <button id="toggleSidebar" class="text-2xl mr-4">
                ☰
            </button>
            <h1 class="text-2xl font-bold">@yield('page-title')</h1>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="p-6">
            @yield('content')
        </main>

    </div>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    document.getElementById('toggleSidebar').onclick = () => {
        sidebar.classList.toggle('hidden');
    };
    document.getElementById('closeSidebar')?.addEventListener('click', () => {
        sidebar.classList.add('hidden');
    });
</script>

</body>
</html>