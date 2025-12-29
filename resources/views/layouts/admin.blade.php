<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-[#f5f2ea]">

    <aside id="sidebar"
        class="fixed left-0 top-0 z-40 h-screen w-64 bg-teal-800 text-white overflow-y-auto transition-all duration-300">
        <div class="flex items-center justify-between px-6 py-4 border-b border-teal-700">
            <span class="text-xl font-bold">Admin Panel</span>
            <button id="closeSidebar" class="md:hidden text-2xl">✕</button>
        </div>

        <nav class="mt-6 space-y-1 px-3 text-sm">
            <x-admin-link route="admin.dashboard" icon="fa-solid fa-tachometer-alt">
                Dashboard
            </x-admin-link>

            <x-admin-link route="admin.kamar.index" icon="fas fa-home">
                Daftar Kos
            </x-admin-link>

            <x-admin-link route="admin.penyewa.index" icon="fas fa-users">
                Data Penyewa
            </x-admin-link>

            <x-admin-link route="admin.sewa.index" icon="fas fa-tasks">
                Status Sewa Kos
            </x-admin-link>

            <x-admin-link route="admin.pembayaran.index" icon="fa-solid fa-money-bill">
                History Pembayaran
            </x-admin-link>

            <x-admin-link route="admin.keluhan.index" icon="fa-solid fa-comment-dots">
                Keluhan Penyewa
            </x-admin-link>

            <x-admin-link route="admin.pembayaran.verifikasi.index" icon="fa-solid fa-credit-card">
                Verifikasi Pembayaran
            </x-admin-link>

            <x-admin-link route="admin.profil.edit" icon="fa-solid fa-user">
                Profil
            </x-admin-link>

            <x-admin-logout icon="fas fa-sign-out-alt">
                Logout
            </x-admin-logout>
        </nav>
    </aside>

    <div id="content" class="ml-64 min-h-screen">
        <header class="bg-white shadow px-6 py-4 flex items-center">
            <button id="toggleSidebar" class="text-2xl mr-4">
                ☰
            </button>
            <h1 class="text-2xl font-bold">@yield('page-title')</h1>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');

        toggleBtn.onclick = () => {
            sidebar.classList.toggle('hidden');
            content.classList.toggle('ml-64');
        };

        closeBtn?.addEventListener('click', () => {
            sidebar.classList.add('hidden');
            content.classList.remove('ml-64');
        });
    </script>

</body>

</html>