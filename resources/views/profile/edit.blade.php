@extends('layouts.penyewa')

@section('page-title', 'Edit Profil')

@section('content')

{{-- UPDATE INFORMASI AKUN --}}
<div class="mb-10">
    <h2 class="text-xl font-semibold flex items-center gap-2 mb-4">
        <span class="w-1 h-6 bg-blue-600"></span>
        Informasi Akun
    </h2>

    <div class="bg-white rounded-lg shadow p-6 max-w-xl">
        @include('profile.partials.update-profile-information-form')
    </div>
</div>

{{-- UPDATE PASSWORD --}}
<div class="mb-10">
    <h2 class="text-xl font-semibold flex items-center gap-2 mb-4">
        <span class="w-1 h-6 bg-yellow-500"></span>
        Ubah Password
    </h2>

    <div class="bg-white rounded-lg shadow p-6 max-w-xl">
        @include('profile.partials.update-password-form')
    </div>
</div>

{{-- HAPUS AKUN (OPSIONAL) --}}
<div>
    <h2 class="text-xl font-semibold flex items-center gap-2 mb-4 text-red-600">
        <span class="w-1 h-6 bg-red-600"></span>
        Hapus Akun
    </h2>

    <div class="bg-white rounded-lg shadow p-6 max-w-xl">
        @include('profile.partials.delete-user-form')
    </div>
</div>

@endsection