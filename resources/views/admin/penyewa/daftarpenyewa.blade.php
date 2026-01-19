@extends('layouts.admin')

@section('title', 'Daftar Penyewa')
@section('page-title', 'Data Penyewa')

@section('content')
<div class="bg-white shadow-md rounded-lg p-4 sm:p-6 w-full overflow-hidden">

    {{-- TABLE WRAPPER --}}
    <div class="overflow-x-auto border border-gray-200">
        <table class="min-w-full text-sm sm:text-base text-left">
            <thead class="bg-teal-500">
                <tr class="text-white">
                    <th class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center whitespace-nowrap">
                        ID Penyewa
                    </th>
                    <th class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                        Nama
                    </th>
                    <th class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center whitespace-nowrap">
                        No. Telp
                    </th>
                    <th class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                        Email
                    </th>
                </tr>
            </thead>

            <tbody class="bg-[#f3f0ea]">
                @forelse($penyewas as $p)
                    <tr class="border-b border-gray-200 last:border-none hover:bg-gray-50 transition">
                        <td class="px-3 sm:px-6 py-4 sm:py-5 text-center text-gray-800 text-sm sm:text-base">
                            {{ $p->id_penyewa }}
                        </td>
                        <td class="px-3 sm:px-6 py-4 sm:py-5 text-center text-gray-800">
                            {{ $p->user->name ?? '-' }}
                        </td>
                        <td class="px-3 sm:px-6 py-4 sm:py-5 text-center text-gray-700">
                            {{ $p->no_telp_penyewa ?? '-' }}
                        </td>
                        <td class="px-3 sm:px-6 py-4 sm:py-5 text-center text-gray-700">
                            {{ $p->user->email ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="px-3 sm:px-6 py-8 sm:py-10 text-center text-gray-600 text-sm sm:text-base">
                            Belum ada data penyewa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if ($penyewas->hasPages())
      <div class="mt-6 flex justify-center">
        {{ $penyewas->links('components.pagination') }}
      </div>
    @endif

</div>
@endsection
