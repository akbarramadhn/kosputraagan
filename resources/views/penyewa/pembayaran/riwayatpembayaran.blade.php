@extends('layouts.penyewa')

@section('title', 'Riwayat Pembayaran')
@section('page-title', 'Riwayat Pembayaran')

@section('content')
    <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">

        <div class="p-6 border-b border-slate-200">
            <h1 class="text-xl font-bold text-slate-800">Riwayat Pembayaran</h1>
            <p class="text-sm text-slate-500 mt-1">Daftar pembayaran sewa & perpanjangan kamu.</p>

            {{-- MOBILE: CARD --}}
            <div class="md:hidden p-4 space-y-4">
                @forelse($pembayarans as $p)
                    @php
                        $status = $p->status_pembayaran ?? '-';
                        $statusBg = 'bg-slate-100 text-slate-700';
                        if ($status === 'Terverifikasi')
                            $statusBg = 'bg-green-100 text-green-800';
                        if ($status === 'Ditolak')
                            $statusBg = 'bg-red-100 text-red-800';
                        if ($status === 'Sedang Ditinjau')
                            $statusBg = 'bg-yellow-100 text-yellow-800';
                    @endphp

                    <div class="rounded-xl border border-slate-200 bg-[#f7f3ea] p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="font-semibold text-slate-800">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pembayaran)->format('Y-m-d') }}
                                    <span class="text-slate-500 font-normal">
                                        • {{ \Carbon\Carbon::parse($p->tanggal_pembayaran)->format('H:i') }}
                                    </span>
                                </div>
                                <div class="text-xs text-slate-500 mt-1">{{ $p->tipe_pembayaran ?? '-' }}</div>
                            </div>

                            <span class="inline-flex rounded-lg px-3 py-1 text-xs font-semibold {{ $statusBg }}">
                                {{ $status }}
                            </span>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <div class="text-xs text-slate-500">No. Kamar</div>
                                <div class="font-semibold text-slate-800">{{ $p->no_kamar }}</div>
                            </div>

                            <div>
                                <div class="text-xs text-slate-500">Jumlah Bayar</div>
                                <div class="font-semibold text-slate-800">
                                    Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                                </div>
                            </div>

                            <div>
                                <div class="text-xs text-slate-500">Jenis Pembayaran</div>
                                <div class="font-semibold text-slate-800">{{ $p->jenis_pembayaran ?? '-' }}</div>
                            </div>

                            <div>
                                <div class="text-xs text-slate-500">Tenggat</div>
                                <div class="font-semibold text-slate-800">
                                    {{ $p->tenggat_pembayaran ? \Carbon\Carbon::parse($p->tenggat_pembayaran)->format('Y-m-d') : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="text-xs text-slate-500">Bukti</div>
                            @if($p->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $p->bukti_pembayaran) }}" target="_blank"
                                    class="inline-flex items-center gap-2">
                                    <img src="{{ asset('storage/' . $p->bukti_pembayaran) }}"
                                        class="h-14 w-14 object-cover rounded-lg border border-slate-200 bg-white">
                                    <span class="text-sm text-slate-700 hover:underline">Lihat</span>
                                </a>
                            @else
                                <span class="text-sm text-slate-700">-</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-10 text-center text-slate-500">Belum ada riwayat pembayaran.</div>
                @endforelse
            </div>

            {{-- DESKTOP: TABLE --}}
            <div class="hidden md:block">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-[#2f9aa0] text-white">
                            <tr>
                                <th class="px-6 py-4 text-center">Tanggal Bayar</th>
                                <th class="px-6 py-4 text-center">No. Kamar</th>
                                <th class="px-6 py-4 text-center">Jumlah Bayar</th>
                                <th class="px-6 py-4 text-center">Jenis Pembayaran</th>
                                <th class="px-6 py-4 text-center">Tenggat</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Bukti</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">
                            @forelse($pembayarans as $p)
                                @php
                                    $status = $p->status_pembayaran ?? '-';

                                    // badge status (bukan background td)
                                    $statusBadge = 'bg-slate-100 text-slate-700';
                                    if ($status === 'Terverifikasi')
                                        $statusBadge = 'bg-green-100 text-green-800';
                                    if ($status === 'Sedang Ditinjau')
                                        $statusBadge = 'bg-yellow-100 text-yellow-800';
                                    if ($status === 'Ditolak')
                                        $statusBadge = 'bg-red-100 text-red-800';

                                    // badge jenis
                                    $jenisBadge = 'bg-emerald-100 text-emerald-800';
                                @endphp

                                <tr class="bg-[#f7f3ea]">
                                    <td class="px-6 py-4 align-middle text-center">
                                        <div class="text-slate-900 font-medium whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($p->tanggal_pembayaran)->format('Y-m-d') }}
                                        </div>
                                        <div class="text-slate-600 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($p->tanggal_pembayaran)->format('H:i:s') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-center align-middle font-semibold text-slate-900">
                                        {{ $p->no_kamar }}
                                    </td>

                                    <td class="px-6 py-4 text-center align-middle text-slate-900 whitespace-nowrap">
                                        Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                                    </td>

                                    {{-- jenis: badge kecil --}}
                                    <td class="px-6 py-4 text-center align-middle">
                                        <span
                                            class="inline-flex items-center rounded-lg px-3 py-1 text-xs font-semibold {{ $jenisBadge }}">
                                            {{ $p->jenis_pembayaran ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center align-middle text-slate-900 whitespace-nowrap">
                                        {{ $p->tenggat_pembayaran ? \Carbon\Carbon::parse($p->tenggat_pembayaran)->format('Y-m-d') : '-' }}
                                    </td>

                                    {{-- status: badge kecil --}}
                                    <td class="px-6 py-4 text-center align-middle">
                                        <span
                                            class="inline-flex items-center rounded-lg px-3 py-1 text-xs font-semibold {{ $statusBadge }}">
                                            {{ $status }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center align-middle">
                                        @if($p->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $p->bukti_pembayaran) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $p->bukti_pembayaran) }}"
                                                    class="mx-auto h-16 w-16 object-cover rounded-lg border border-slate-200 bg-white">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-slate-500">
                                        Belum ada riwayat pembayaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="p-6">
                {{ $pembayarans->links() }}
            </div>
        </div>

    </div>
@endsection