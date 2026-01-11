<x-public-layout>
    <div class="min-h-[calc(100vh-120px)] bg-[#f6f3eb] py-10">
        <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('info'))
                <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-amber-800">
                    {{ session('info') }}
                </div>
            @endif

            <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                Selamat Datang, <span class="text-[#006a71]">{{ $user->name }}</span> !
            </h1>

            {{-- ============ INFORMASI AKUN ============ --}}
            <div class="mt-10">
                <div class="flex items-center gap-3">
                    <span class="h-8 w-[3px] rounded-full bg-blue-600"></span>
                    <h2 class="text-2xl font-extrabold text-slate-900">Informasi Akun</h2>
                </div>

                <div class="mt-4 rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="space-y-4 text-sm">
                        @php
                            $statusAkun = $penyewa->status ?? 'Menunggu Verifikasi';
                        @endphp

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Nama</div>
                            <div class="col-span-9 flex items-center gap-3">
                                <span class="text-slate-900">: {{ $user->name }}</span>
                                {{-- <a href="#" class="text-blue-600 hover:underline">Edit</a> --}}
                            </div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Email</div>
                            <div class="col-span-9 flex items-center gap-3">
                                <span class="text-slate-900">: {{ $user->email }}</span>
                                {{-- <a href="#" class="text-blue-600 hover:underline">Edit</a> --}}
                            </div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">No. Telepon</div>
                            <div class="col-span-9 flex items-center gap-3">
                                <span class="text-slate-900">: {{ $penyewa->no_telp_penyewa ?? '-' }}</span>
                                {{-- <a href="#" class="text-blue-600 hover:underline">Edit</a> --}}
                            </div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3">
                            <div class="col-span-3 text-slate-600">Status Akun</div>
                            <div class="col-span-9">
                                <span class="text-slate-900">:</span>
                                <span class="ml-2 font-bold {{ $statusAkun === 'Terverifikasi' ? 'text-emerald-700' : 'text-amber-600' }}">
                                    {{ $statusAkun }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ INFORMASI SEWA KOS ============ --}}
            <div class="mt-10">
                <div class="flex items-center gap-3">
                    <span class="h-8 w-[3px] rounded-full bg-blue-600"></span>
                    <h2 class="text-2xl font-extrabold text-slate-900">Informasi Sewa Kos</h2>
                </div>

                <div class="mt-4 rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="space-y-4 text-sm">
                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Tipe Kamar</div>
                            <div class="col-span-9 text-slate-900">: {{ $sewa?->kamar?->tipe_kamar ?? '-' }}</div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Nomor Kamar</div>
                            <div class="col-span-9 text-slate-900">: {{ $sewa?->no_kamar ?? '-' }}</div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Tanggal Mulai</div>
                            <div class="col-span-9 text-slate-900">
                                : {{ $sewa?->tanggal_mulai ? \Illuminate\Support\Carbon::parse($sewa->tanggal_mulai)->format('d M Y') : '-' }}
                            </div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Tanggal Selesai</div>
                            <div class="col-span-9 text-slate-900">
                                : {{ $sewa?->tanggal_selesai ? \Illuminate\Support\Carbon::parse($sewa->tanggal_selesai)->format('d M Y') : '-' }}
                            </div>
                        </div>

                        @php
                            $sisa = $sewa?->tanggal_selesai
                                ? \Illuminate\Support\Carbon::parse($sewa->tanggal_selesai)->diffForHumans(now(), ['parts' => 2, 'short' => true, 'syntax' => \Illuminate\Support\Carbon::DIFF_ABSOLUTE])
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

            {{-- ============ INFORMASI PEMBAYARAN TERAKHIR ============ --}}
            <div class="mt-10">
                <div class="flex items-center gap-3">
                    <span class="h-8 w-[3px] rounded-full bg-blue-600"></span>
                    <h2 class="text-2xl font-extrabold text-slate-900">Informasi Pembayaran Terakhir</h2>
                </div>

                @php
                    $statusBayar = $pembayaran->status_pembayaran ?? 'Sedang Ditinjau';
                    $jenisBayar = ($pembayaran->tipe_pembayaran ?? null) === 'Pelunasan' ? 'Lunas' : ($pembayaran->tipe_pembayaran ?? '-');

                    $sisaTenggat = $pembayaran?->tenggat_pembayaran
                        ? \Illuminate\Support\Carbon::parse($pembayaran->tenggat_pembayaran)->diffForHumans(now(), ['parts' => 2, 'short' => true, 'syntax' => \Illuminate\Support\Carbon::DIFF_ABSOLUTE])
                        : null;
                @endphp

                <div class="mt-4 rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="space-y-4 text-sm">

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Tanggal Pembayaran</div>
                            <div class="col-span-9 text-slate-900">
                                : {{ $pembayaran->tanggal_pembayaran ? \Illuminate\Support\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y') : '-' }}
                            </div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Tenggat Pembayaran</div>
                            <div class="col-span-9 text-slate-900">
                                : {{ $pembayaran->tenggat_pembayaran ? \Illuminate\Support\Carbon::parse($pembayaran->tenggat_pembayaran)->format('d M Y') : '-' }}
                            </div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Jenis Pembayaran</div>
                            <div class="col-span-9">
                                <span class="text-slate-900">:</span>
                                <span class="ml-2 font-bold text-emerald-700">{{ $jenisBayar }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Jumlah Bayar</div>
                            <div class="col-span-9 text-slate-900">
                                : {{ $pembayaran->jumlah_bayar ? number_format((float)$pembayaran->jumlah_bayar, 0, ',', '.') : '-' }}
                            </div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3 border-b border-dashed border-slate-200 pb-4">
                            <div class="col-span-3 text-slate-600">Sisa Hari Pembayaran</div>
                            <div class="col-span-9 text-slate-900">: {{ $sisaTenggat ?? '-' }}</div>
                        </div>

                        <div class="grid grid-cols-12 items-center gap-3">
                            <div class="col-span-3 text-slate-600">Status Pembayaran</div>
                            <div class="col-span-9">
                                <span class="text-slate-900">:</span>
                                <span class="ml-2 font-bold
                                    {{ $statusBayar === 'Terverifikasi' ? 'text-emerald-700' : ($statusBayar === 'Ditolak' ? 'text-red-700' : 'text-amber-600') }}">
                                    {{ $statusBayar }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-public-layout>