<x-public-layout>
    <div class="min-h-[calc(100vh-120px)] bg-[#f6f3eb] py-16">
        <div class="mx-auto w-full max-w-md px-4">
            <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200 shadow-xl">

                <h1 class="text-center text-2xl font-extrabold tracking-tight text-slate-800">
                    Form <span class="text-[#006a71]">Pembayaran</span>
                </h1>

                <p class="mt-2 text-center text-sm text-slate-500">
                    Lengkapi pembayaran untuk melanjutkan proses perpanjangan kos.
                </p>

                {{-- ALERT --}}
                @if(session('success'))
                    <div class="mt-5 rounded-xl bg-green-100 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mt-5 rounded-xl bg-red-100 px-4 py-3 text-sm text-red-800">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST"
                      action="{{ route('penyewa.perpanjang.pembayaran.submit') }}"
                      enctype="multipart/form-data"
                      class="mt-6 space-y-5">
                    @csrf

                    {{-- TANGGAL SELESAI BARU --}}
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">
                            Tanggal Selesai Baru
                        </label>
                        <input type="date"
                               value="{{ $tanggalBaru }}"
                               readonly
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm">
                    </div>

                    {{-- JUMLAH BAYAR (AUTO) --}}
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">
                            Jumlah Bayar
                        </label>
                        <input type="text"
                               value="Rp {{ number_format($jumlahBayar, 0, ',', '.') }}"
                               readonly
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800">
                        {{-- hidden value buat dikirim ke backend --}}
                        <input type="hidden" name="jumlah_bayar" value="{{ $jumlahBayar }}">
                    </div>

                    {{-- METODE --}}
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">
                            Metode Pembayaran
                        </label>
                        <select name="metode_pembayaran"
                                required
                                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-[#006a71] focus:ring-4 focus:ring-[#006a71]/15">
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>

                    {{-- BUKTI --}}
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">
                            Bukti Pembayaran
                        </label>
                        <input type="file"
                               name="bukti_pembayaran"
                               required
                               class="block w-full text-sm text-slate-600">
                        <p class="mt-1 text-xs text-slate-500">
                            jpg / png / webp / pdf (maks 4MB)
                        </p>
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-[#006a71] py-3 text-sm font-bold text-white shadow-md hover:bg-[#005a60] transition">
                        Bayar
                    </button>

                    <div class="text-center">
                        <a href="{{ route('penyewa.perpanjang.index') }}"
                           class="text-sm text-slate-600 hover:underline">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-public-layout>