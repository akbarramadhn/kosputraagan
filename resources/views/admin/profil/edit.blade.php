@extends('layouts.admin')

@section('page-title', 'Profil Saya')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="block mb-2">Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="border rounded p-2 w-full mb-4">

        <label class="block mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="border rounded p-2 w-full mb-4">

        <label class="block mb-2">Password Baru (kosongkan jika tidak ingin diubah)</label>
        <input type="password" name="password" class="border rounded p-2 w-full mb-4">

        <label class="block mb-2">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="border rounded p-2 w-full mb-4">

        <button type="submit" class="bg-teal-700 text-white px-4 py-2 rounded hover:bg-teal-800">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
