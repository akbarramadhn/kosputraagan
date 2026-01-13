<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register | Kos Putra Agan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-teal-700 to-teal-300 px-4 sm:px-6 lg:px-8">

    <div class="bg-[#f6f3eb] w-full max-w-sm sm:max-w-md md:max-w-lg p-6 sm:p-8 md:p-10 rounded-2xl shadow-2xl">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center mb-6 sm:mb-8 text-gray-800">
            Daftar Akun Kos Putra Agan
        </h2>

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-3 sm:p-4 text-xs sm:text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5">
            @csrf

            {{-- NAME --}}
            <div>
                <label class="block mb-2 text-sm sm:text-base font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 focus:border-teal-500 focus:ring-2 focus:ring-teal-400 text-sm sm:text-base">
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs sm:text-sm" />
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block mb-2 text-sm sm:text-base font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 focus:border-teal-500 focus:ring-2 focus:ring-teal-400 text-sm sm:text-base">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs sm:text-sm" />
            </div>

            {{-- NO TELP --}}
            <div>
                <label class="block mb-2 text-sm sm:text-base font-medium text-gray-700">No. Telepon</label>
                <input type="text" name="no_telp" value="{{ old('no_telp') }}" required
                    class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 focus:border-teal-500 focus:ring-2 focus:ring-teal-400 text-sm sm:text-base"
                    placeholder="08xxxxxxxxxx">
                <x-input-error :messages="$errors->get('no_telp')" class="mt-1 text-xs sm:text-sm" />
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block mb-2 text-sm sm:text-base font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 focus:border-teal-500 focus:ring-2 focus:ring-teal-400 text-sm sm:text-base">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs sm:text-sm" />
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="mb-4 sm:mb-6">
                <label class="block mb-2 text-sm sm:text-base font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 focus:border-teal-500 focus:ring-2 focus:ring-teal-400 text-sm sm:text-base">
            </div>

            {{-- BUTTON --}}
            <div>
                <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2.5 sm:py-3 rounded-lg text-sm sm:text-base transition">
                    Daftar
                </button>
            </div>
        </form>

        {{-- LOGIN LINK --}}
        <p class="text-center text-xs sm:text-sm mt-5 sm:mt-6 text-gray-700">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:underline">
                Login
            </a>
        </p>
    </div>

</body>

</html>
