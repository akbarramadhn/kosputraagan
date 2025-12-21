<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-[#f5f2ea]">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside id="sidebar" class="w-64 bg-teal-900 text-white transition-all duration-300">

            {{-- LOGO --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-teal-700">
                <span class="text-xl font-bold">Admin Panel</span>
                <button id="closeSidebar" class="md:hidden text-2xl">✕</button>
            </div>

            {{-- MENU --}}
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