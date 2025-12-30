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
                {{-- ADMIN --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-yellow-400 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">
                        Admin Dashboard
                    </a>
                @endif

                {{-- PENYEWA: tombol Akun Saya (muncul sesuai flow) --}}
                @if($showAkunSaya)
                    <a href="{{ $akunSayaHref }}" class="nav-link">
                        Akun Saya
                    </a>
                @endif

                {{-- LOGOUT selalu tampil ketika login --}}
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
    </nav>

    <main class="pt-10">
        {{ $slot }}
    </main>

</body>

</html>