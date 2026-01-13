@extends('layouts.penyewa')

@section('page-title', 'Edit Profil')

@section('content')

<div class="px-4 sm:px-6 md:px-8 py-6 sm:py-8 bg-[#f6f3eb] min-h-screen">

    {{-- UPDATE INFORMASI AKUN --}}
    <div class="mb-8 sm:mb-10">
        <h2 class="text-lg sm:text-xl md:text-2xl font-semibold flex items-center gap-2 mb-3 sm:mb-4">
            <span class="w-1 sm:w-1.5 h-5 sm:h-6 bg-blue-600"></span>
            Informasi Akun
        </h2>

        <div class="bg-white rounded-lg shadow p-4 sm:p-6 md:p-8 max-w-md sm:max-w-lg md:max-w-xl mx-auto">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- UPDATE PASSWORD --}}
    <div class="mb-8 sm:mb-10">
        <h2 class="text-lg sm:text-xl md:text-2xl font-semibold flex items-center gap-2 mb-3 sm:mb-4">
            <span class="w-1 sm:w-1.5 h-5 sm:h-6 bg-yellow-500"></span>
            Ubah Password
        </h2>

        <div class="bg-white rounded-lg shadow p-4 sm:p-6 md:p-8 max-w-md sm:max-w-lg md:max-w-xl mx-auto">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- HAPUS AKUN --}}
    <div>
        <h2 class="text-lg sm:text-xl md:text-2xl font-semibold flex items-center gap-2 mb-3 sm:mb-4 text-red-600">
            <span class="w-1 sm:w-1.5 h-5 sm:h-6 bg-red-600"></span>
            Hapus Akun
        </h2>

        <div class="bg-white rounded-lg shadow p-4 sm:p-6 md:p-8 max-w-md sm:max-w-lg md:max-w-xl mx-auto">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection
