@extends('layouts.penyewa')

@section('title', 'Profile Penyewa')
@section('page-title', 'Profile')

@section('content')
    <div x-data>
        {{-- INFORMASI AKUN --}}
        <div class="mb-10">
            <h2 class="text-xl font-semibold flex items-center gap-2 mb-4">
                <span class="w-1 h-6 bg-blue-600"></span>
                Informasi Akun
            </h2>

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <table class="w-full text-sm">

                    {{-- NAMA --}}
                    <tr class="border-b" x-data="{ edit:false }">
                        <td class="py-3 w-48">Nama</td>

                        <td class="py-3">
                            <template x-if="!edit">
                                <span>: {{ auth()->user()->name }}</span>
                            </template>

                            <template x-if="edit">
                                <form action="{{ route('penyewa.profil') }}" method="POST"
                                    class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                                    @csrf
                                    @method('PUT')

                                    <span class="text-gray-500 sm:pt-2">:</span>

                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm sm:text-base outline-none focus:ring-2 focus:ring-blue-500">

                                    <div class="flex gap-2">
                                        <button
                                            class="rounded-lg bg-blue-600 px-3 sm:px-4 py-2 text-white hover:bg-blue-700 text-sm sm:text-base">
                                            Simpan
                                        </button>
                                        <button type="button" @click="edit=false"
                                            class="rounded-lg bg-gray-200 px-3 sm:px-4 py-2 text-gray-800 hover:bg-gray-300 text-sm sm:text-base">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </template>

                        </td>

                        <td class="py-3 text-right">
                            <button type="button" class="text-blue-600 cursor-pointer" x-show="!edit" @click="edit=true">
                                Edit
                            </button>
                        </td>
                    </tr>

                    {{-- EMAIL --}}
                    <tr class="border-b" x-data="{ edit:false }">
                        <td class="py-3">Email</td>

                        <td class="py-3">
                            <template x-if="!edit">
                                <span>: {{ auth()->user()->email }}</span>
                            </template>

                            <template x-if="edit">
                                <form action="{{ route('penyewa.profil') }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')

                                    <span class="text-gray-500">:</span>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
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
                        </td>

                        <td class="py-3 text-right">
                            <button type="button" class="text-blue-600 cursor-pointer" x-show="!edit" @click="edit=true">
                                Edit
                            </button>
                        </td>
                    </tr>

                    {{-- NO. TELEPON --}}
                    <tr class="border-b" x-data="{ edit:false }">
                        <td class="py-3">No. Telepon</td>

                        <td class="py-3">
                            <template x-if="!edit">
                                <span>: {{ $penyewa->no_telp_penyewa }}</span>
                            </template>

                            <template x-if="edit">
                                <form action="{{ route('penyewa.profil') }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')

                                    <span class="text-gray-500">:</span>
                                    <input type="text" name="no_telp_penyewa"
                                        value="{{ old('no_telp_penyewa', $penyewa->no_telp_penyewa) }}"
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
                        </td>

                        <td class="py-3 text-right">
                            <button type="button" class="text-blue-600 cursor-pointer" x-show="!edit" @click="edit=true">
                                Edit
                            </button>
                        </td>
                    </tr>

                    {{-- PASSWORD --}}
                    <tr class="border-b" x-data="{ edit:false }">
                        <td class="py-3">Password</td>

                        <td class="py-3">
                            <template x-if="!edit">
                                <span>: ********</span>
                            </template>

                            <template x-if="edit">
                                <form action="{{ route('penyewa.profil') }}" method="POST" class="space-y-2">
                                    @csrf
                                    @method('PUT')

                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500">:</span>
                                        <input type="password" name="password"
                                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Password baru">
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500"> </span>
                                        <input type="password" name="password_confirmation"
                                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Konfirmasi password">
                                    </div>

                                    <div class="flex gap-2 justify-end">
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
                        </td>

                        <td class="py-3 text-right">
                            <button type="button" class="text-blue-600 cursor-pointer" x-show="!edit" @click="edit=true">
                                Edit
                            </button>
                        </td>
                    </tr>

                    {{-- STATUS AKUN (tanpa edit) --}}
                    <tr>
                        <td class="py-3">Status Akun</td>
                        <td class="py-3">
                            : <span class="text-green-600 font-semibold">{{ $penyewa->status_akun }}</span>
                        </td>
                        <td class="py-3"></td>
                    </tr>

                </table>
            </div>
        </div>

        {{-- INFORMASI SEWA --}}
        <div class="mt-10">
            <div class="flex items-center gap-3">
                <span class="h-8 w-[3px] rounded-full bg-blue-600"></span>
                <h2 class="text-2xl font-extrabold text-slate-900">Informasi Sewa Kos</h2>
            </div>

            <div class="mt-4 rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                <div class="space-y-4 text-sm">
                    <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                        <div class="col-span-3 text-slate-600">Tipe Kamar</div>
                        <div class="col-span-9 text-slate-900">: {{ $sewaAktif?->kamar?->tipe_kamar ?? '-' }}</div>
                    </div>

                    <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                        <div class="col-span-3 text-slate-600">Nomor Kamar</div>
                        <div class="col-span-9 text-slate-900">: {{ $sewaAktif?->no_kamar ?? '-' }}</div>
                    </div>

                    <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                        <div class="col-span-3 text-slate-600">Tanggal Mulai</div>
                        <div class="col-span-9 text-slate-900">
                            :
                            {{ $sewaAktif?->tanggal_mulai ? \Illuminate\Support\Carbon::parse($sewaAktif->tanggal_mulai)->format('d M Y') : '-' }}
                        </div>
                    </div>

                    <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                        <div class="col-span-3 text-slate-600">Tanggal Selesai</div>
                        <div class="col-span-9 text-slate-900">
                            :
                            {{ $sewaAktif?->tanggal_selesai ? \Illuminate\Support\Carbon::parse($sewaAktif->tanggal_selesai)->format('d M Y') : '-' }}
                        </div>
                    </div>

                    @php
                        $sisa = $sewaAktif?->tanggal_selesai
                            ? \Illuminate\Support\Carbon::parse($sewaAktif->tanggal_selesai)->diffForHumans(now(), ['parts' => 2, 'short' => true, 'syntax' => \Illuminate\Support\Carbon::DIFF_ABSOLUTE])
                            : null;
                    @endphp

                    <div class="grid grid-cols-12 items-center gap-3">
                        <div class="col-span-3 text-slate-600">Sisa Hari Sewa</div>
                        <div class="col-span-9">
                            <span class="text-slate-900">:</span>
                            <span class="ml-2 font-bold text-emerald-700">{{ $sisa ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection