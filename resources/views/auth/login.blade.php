<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Kos Putra Agan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-teal-700 to-teal-300">

    <div class="bg-[#f6f3eb] w-full max-w-md p-8 rounded-2xl shadow-2xl">
        <h2 class="text-2xl font-bold text-center mb-8">
            Login Kos Putra Agan
        </h2>

        {{-- SESSION STATUS --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                >
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            {{-- PASSWORD --}}
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium">Password</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                >
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            {{-- BUTTON --}}
            <button
                type="submit"
                class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-lg transition"
            >
                Login
            </button>
        </form>

        {{-- REGISTER LINK --}}
        <p class="text-center text-sm mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-teal-600 font-semibold hover:underline">
                Daftar sekarang
            </a>
        </p>
    </div>

</body>
</html>