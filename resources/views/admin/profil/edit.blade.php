@extends('layouts.admin')

@section('page-title', 'Profil Saya')

@section('content')
    <div class="min-h-[70vh] rounded-2xl bg-white p-8 shadow">
        {{-- Header seperti gambar --}}
        <div class="mb-6 flex items-center gap-4">
            <div class="h-10 w-1 rounded bg-blue-600"></div>
            <h1 class="text-3xl font-bold text-gray-900">Informasi Akun</h1>
        </div>

        {{-- Alert sukses --}}
        @if(session('success'))
            <div class="mb-5 rounded-lg bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Card list --}}
        <div class="rounded-2xl bg-gray-50 p-6 shadow-sm">
            <div class="divide-y divide-gray-200">

                {{-- NAMA --}}
                <div x-data="{ edit:false }" class="py-4">
                    <div class="grid grid-cols-12 items-center gap-4">
                        <div class="col-span-3 text-lg text-gray-700">Nama</div>
                        <div class="col-span-1 text-center text-lg text-gray-400">:</div>

                        <div class="col-span-6">
                            <template x-if="!edit">
                                <div class="text-lg text-gray-900">{{ $user->name }}</div>
                            </template>

                            <template x-if="edit">
                                <form action="{{ route('admin.profil.update') }}" method="POST"
                                    class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500">

                                    <button class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                                        Simpan
                                    </button>
                                    <button type="button" @click="edit=false"
                                        class="rounded-lg bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300">
                                        Batal
                                    </button>
                                </form>
                            </template>
                        </div>

                        <div class="col-span-2 text-right">
                            <button type="button" @click="edit=true" x-show="!edit" class="text-blue-600 hover:underline">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>

                {{-- EMAIL --}}
                <div x-data="{ edit:false }" class="py-4">
                    <div class="grid grid-cols-12 items-center gap-4">
                        <div class="col-span-3 text-lg text-gray-700">Email</div>
                        <div class="col-span-1 text-center text-lg text-gray-400">:</div>

                        <div class="col-span-6">
                            <template x-if="!edit">
                                <div class="text-lg text-gray-900">{{ $user->email }}</div>
                            </template>

                            <template x-if="edit">
                                <form action="{{ route('admin.profil.update') }}" method="POST"
                                    class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')

                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500">

                                    <button class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                                        Simpan
                                    </button>
                                    <button type="button" @click="edit=false"
                                        class="rounded-lg bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300">
                                        Batal
                                    </button>
                                </form>
                            </template>
                        </div>

                        <div class="col-span-2 text-right">
                            <button type="button" @click="edit=true" x-show="!edit" class="text-blue-600 hover:underline">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>

                {{-- NO TELEPON (di tabel admin) --}}
                <div x-data="{ edit:false }" class="py-4">
                    <div class="grid grid-cols-12 items-center gap-4">
                        <div class="col-span-3 text-lg text-gray-700">No. Telepon</div>
                        <div class="col-span-1 text-center text-lg text-gray-400">:</div>

                        <div class="col-span-6">
                            <template x-if="!edit">
                                <div class="text-lg text-gray-900">
                                    {{ $admin->no_telp_admin ?? '-' }}
                                </div>
                            </template>

                            <template x-if="edit">
                                <form action="{{ route('admin.profil.update') }}" method="POST"
                                    class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')

                                    <input type="text" name="no_telp_admin"
                                        value="{{ old('no_telp_admin', $admin->no_telp_admin ?? '') }}"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Masukkan no telepon">

                                    <button class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                                        Simpan
                                    </button>
                                    <button type="button" @click="edit=false"
                                        class="rounded-lg bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300">
                                        Batal
                                    </button>
                                </form>
                            </template>
                        </div>

                        <div class="col-span-2 text-right">
                            <button type="button" @click="edit=true" x-show="!edit" class="text-blue-600 hover:underline">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>

                {{-- PASSWORD --}}
                <div x-data="{ edit:false }" class="py-4">
                    <div class="grid grid-cols-12 items-center gap-4">
                        <div class="col-span-3 text-lg text-gray-700">Password</div>
                        <div class="col-span-1 text-center text-lg text-gray-400">:</div>

                        <div class="col-span-6">
                            <template x-if="!edit">
                                <div class="text-lg text-gray-900">********</div>
                            </template>

                            <template x-if="edit">
                                <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-2">
                                    @csrf
                                    @method('PUT')

                                    <input type="password" name="password"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Password baru">

                                    <input type="password" name="password_confirmation"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Konfirmasi password">

                                    <div class="flex gap-2">
                                        <button class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                                            Simpan
                                        </button>
                                        <button type="button" @click="edit=false"
                                            class="rounded-lg bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </template>
                        </div>

                        <div class="col-span-2 text-right">
                            <button type="button" @click="edit=true" x-show="!edit" class="text-blue-600 hover:underline">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection