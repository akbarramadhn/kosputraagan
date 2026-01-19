@extends('layouts.admin')

@section('title', 'Profil Admin')
@section('page-title', 'Profil Saya')

@section('content')
<div class="min-h-[70vh] rounded-2xl bg-white p-4 sm:p-6 md:p-8 shadow">
    
    {{-- Header --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:gap-4 text-center sm:text-left">
        <div class="flex justify-center sm:justify-start mb-3 sm:mb-0">
            <div class="h-8 w-1 rounded bg-blue-600"></div>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
            Informasi Akun
        </h1>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="mb-5 rounded-lg bg-green-50 px-4 py-3 text-green-700 text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card utama --}}
    <div class="rounded-2xl bg-gray-50 p-4 sm:p-6 md:p-8 shadow-sm">
        <div class="divide-y divide-gray-200 space-y-2 sm:space-y-3">

            {{-- NAMA --}}
            <div x-data="{ edit:false }" class="py-3 sm:py-4">
                <div class="grid grid-cols-1 sm:grid-cols-12 items-start sm:items-center gap-3 sm:gap-4">
                    <div class="sm:col-span-3 text-base sm:text-lg text-gray-700 text-center sm:text-left">Nama</div>
                    <div class="hidden sm:block sm:col-span-1 text-center text-lg text-gray-400">:</div>

                    <div class="sm:col-span-6">
                        <template x-if="!edit">
                            <div class="text-base sm:text-lg text-gray-900 text-center sm:text-left">
                                {{ $user->name }}
                            </div>
                        </template>

                        <template x-if="edit">
                            <form action="{{ route('admin.profil.update') }}" method="POST"
                                class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm sm:text-base outline-none focus:ring-2 focus:ring-blue-500">

                                <div class="flex gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 sm:px-4 py-2 text-white hover:bg-blue-700 text-sm sm:text-base">
                                        Simpan
                                    </button>
                                    <button type="button" @click="edit=false"
                                        class="rounded-lg bg-gray-200 px-3 sm:px-4 py-2 text-gray-800 hover:bg-gray-300 text-sm sm:text-base">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </template>
                    </div>

                    <div class="sm:col-span-2 text-center sm:text-right mt-3 sm:mt-0">
                        <button type="button" @click="edit=true" x-show="!edit"
                            class="text-blue-600 hover:underline text-sm sm:text-base">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            {{-- EMAIL --}}
            <div x-data="{ edit:false }" class="py-3 sm:py-4">
                <div class="grid grid-cols-1 sm:grid-cols-12 items-start sm:items-center gap-3 sm:gap-4">
                    <div class="sm:col-span-3 text-base sm:text-lg text-gray-700 text-center sm:text-left">Email</div>
                    <div class="hidden sm:block sm:col-span-1 text-center text-lg text-gray-400">:</div>

                    <div class="sm:col-span-6">
                        <template x-if="!edit">
                            <div class="text-base sm:text-lg text-gray-900 text-center sm:text-left">
                                {{ $user->email }}
                            </div>
                        </template>

                        <template x-if="edit">
                            <form action="{{ route('admin.profil.update') }}" method="POST"
                                class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                                @csrf
                                @method('PUT')

                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm sm:text-base outline-none focus:ring-2 focus:ring-blue-500">

                                <div class="flex gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 sm:px-4 py-2 text-white hover:bg-blue-700 text-sm sm:text-base">
                                        Simpan
                                    </button>
                                    <button type="button" @click="edit=false"
                                        class="rounded-lg bg-gray-200 px-3 sm:px-4 py-2 text-gray-800 hover:bg-gray-300 text-sm sm:text-base">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </template>
                    </div>

                    <div class="sm:col-span-2 text-center sm:text-right mt-3 sm:mt-0">
                        <button type="button" @click="edit=true" x-show="!edit"
                            class="text-blue-600 hover:underline text-sm sm:text-base">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            {{-- NO TELEPON --}}
            <div x-data="{ edit:false }" class="py-3 sm:py-4">
                <div class="grid grid-cols-1 sm:grid-cols-12 items-start sm:items-center gap-3 sm:gap-4">
                    <div class="sm:col-span-3 text-base sm:text-lg text-gray-700 text-center sm:text-left">No. Telepon</div>
                    <div class="hidden sm:block sm:col-span-1 text-center text-lg text-gray-400">:</div>

                    <div class="sm:col-span-6">
                        <template x-if="!edit">
                            <div class="text-base sm:text-lg text-gray-900 text-center sm:text-left">
                                {{ $admin->no_telp_admin ?? '-' }}
                            </div>
                        </template>

                        <template x-if="edit">
                            <form action="{{ route('admin.profil.update') }}" method="POST"
                                class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="no_telp_admin"
                                    value="{{ old('no_telp_admin', $admin->no_telp_admin ?? '') }}"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm sm:text-base outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan no telepon">

                                <div class="flex gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 sm:px-4 py-2 text-white hover:bg-blue-700 text-sm sm:text-base">
                                        Simpan
                                    </button>
                                    <button type="button" @click="edit=false"
                                        class="rounded-lg bg-gray-200 px-3 sm:px-4 py-2 text-gray-800 hover:bg-gray-300 text-sm sm:text-base">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </template>
                    </div>

                    <div class="sm:col-span-2 text-center sm:text-right mt-3 sm:mt-0">
                        <button type="button" @click="edit=true" x-show="!edit"
                            class="text-blue-600 hover:underline text-sm sm:text-base">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            {{-- PASSWORD --}}
            <div x-data="{ edit:false }" class="py-3 sm:py-4">
                <div class="grid grid-cols-1 sm:grid-cols-12 items-start sm:items-center gap-3 sm:gap-4">
                    <div class="sm:col-span-3 text-base sm:text-lg text-gray-700 text-center sm:text-left">Password</div>
                    <div class="hidden sm:block sm:col-span-1 text-center text-lg text-gray-400">:</div>

                    <div class="sm:col-span-6">
                        <template x-if="!edit">
                            <div class="text-base sm:text-lg text-gray-900 text-center sm:text-left">
                                ********
                            </div>
                        </template>

                        <template x-if="edit">
                            <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-2">
                                @csrf
                                @method('PUT')

                                <input type="password" name="password"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm sm:text-base outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Password baru">

                                <input type="password" name="password_confirmation"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm sm:text-base outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Konfirmasi password">

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <button class="rounded-lg bg-blue-600 px-3 sm:px-4 py-2 text-white hover:bg-blue-700 text-sm sm:text-base">
                                        Simpan
                                    </button>
                                    <button type="button" @click="edit=false"
                                        class="rounded-lg bg-gray-200 px-3 sm:px-4 py-2 text-gray-800 hover:bg-gray-300 text-sm sm:text-base">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </template>
                    </div>

                    <div class="sm:col-span-2 text-center sm:text-right mt-3 sm:mt-0">
                        <button type="button" @click="edit=true" x-show="!edit"
                            class="text-blue-600 hover:underline text-sm sm:text-base">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
