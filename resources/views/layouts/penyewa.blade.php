<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel Penyewa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-[#f5f2ea]">

<div class="min-h-screen">

    {{-- OVERLAY (mobile) --}}
    <div id="sidebarOverlay"
         class="fixed inset-0 z-30 bg-black/40 hidden md:hidden"></div>

    {{-- SIDEBAR --}}
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-40 w-64 bg-teal-800 text-white overflow-y-auto
                  transform -translate-x-full md:translate-x-0 transition-transform duration-300">

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

            <x-penyewa-link route="penyewa.pembayaran.riwayatpembayaran" icon="fa-solid fa-money-bill">
                Riwayat Pembayaran
            </x-penyewa-link>

            <x-penyewa-logout icon="fas fa-sign-out-alt">
                Logout
            </x-penyewa-logout>
        </nav>
    </aside>

    {{-- CONTENT WRAPPER --}}
    <div class="md:ml-64 min-h-screen flex flex-col">

        {{-- NAVBAR --}}
        <header class="bg-white shadow px-6 py-4 flex items-center sticky top-0 z-20">
            <button id="toggleSidebar" class="text-2xl mr-4 md:hidden">
                ☰
            </button>
            <h1 class="text-2xl font-bold">@yield('page-title')</h1>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="p-6 flex-1">
            @yield('content')
        </main>
    </div>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const btnToggle = document.getElementById('toggleSidebar');
    const btnClose = document.getElementById('closeSidebar');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // lock scroll on mobile
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    btnToggle?.addEventListener('click', openSidebar);
    btnClose?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);

    // kalau pindah ke md ke atas, pastikan overlay & lock ilang
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            sidebar.classList.remove('-translate-x-full');
        } else {
            // di mobile default tertutup
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>

</body>
</html>