<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Kos Putra Agan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-teal-700 to-teal-300 px-4 sm:px-6 lg:px-8">

    <div class="bg-[#f6f3eb] w-full max-w-sm sm:max-w-md md:max-w-lg p-6 sm:p-8 md:p-10 rounded-2xl shadow-2xl">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center mb-6 sm:mb-8 text-gray-800">
            Login Kos Putra Agan
        </h2>

        {{-- SESSION STATUS --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-5">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="block mb-2 text-sm sm:text-base font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 focus:border-teal-500 focus:ring-2 focus:ring-teal-400 text-sm sm:text-base"
                >
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs sm:text-sm" />
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block mb-2 text-sm sm:text-base font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 focus:border-teal-500 focus:ring-2 focus:ring-teal-400 text-sm sm:text-base"
                >
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs sm:text-sm" />
            </div>

            {{-- BUTTON --}}
            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2.5 sm:py-3 rounded-lg text-sm sm:text-base transition"
                >
                    Login
                </button>
            </div>
        </form>

        {{-- REGISTER LINK --}}
        <p class="text-center text-xs sm:text-sm mt-5 sm:mt-6 text-gray-700">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-teal-600 font-semibold hover:underline">
                Daftar sekarang
            </a>
        </p>
    </div>

</body>
</html>
