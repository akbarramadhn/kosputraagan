<x-public-layout>
    @php
        $nominalLunas =
            $draft['sisa_tagihan'] ??
            $draft['total_bayar'] ??
            $draft['harga_total'] ??
            $draft['total'] ??
            0;
    @endphp

    <div class="min-h-[calc(100vh-120px)] bg-[#f6f3eb] py-10 sm:py-14">
        <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-white p-8 sm:p-10 lg:p-14 border border-slate-200 shadow-2xl">
                <h1 class="text-center text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-800">
                    Form <span class="text-[#006a71]">Pembayaran</span>
                </h1>

                <p class="mt-4 text-center text-base sm:text-lg text-slate-500">
                    Lengkapi pembayaran untuk melanjutkan proses sewa kamar.
                </p>

                @if (session('error'))
                    <div class="mt-6 rounded-2xl bg-red-50 p-4 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl bg-red-50 p-4 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- RINGKASAN BOOKING (DRAFT) --}}
                <div class="mt-10 rounded-2xl border border-slate-100 bg-slate-50 p-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 text-slate-700">
                        <div class="rounded-xl bg-white p-4 text-center shadow-sm">
                            <div class="text-xs font-semibold text-slate-500">Tipe Kamar</div>
                            <div class="mt-1 text-2xl font-extrabold">{{ $draft['tipe_kamar'] ?? '-' }}</div>
                        </div>

                        <div class="rounded-xl bg-white p-4 text-center shadow-sm">
                            <div class="text-xs font-semibold text-slate-500">No Kamar</div>
                            <div class="mt-1 text-2xl font-extrabold">{{ $draft['no_kamar'] ?? '-' }}</div>
                        </div>

                        <div class="rounded-xl bg-white p-4 text-center shadow-sm">
                            <div class="text-xs font-semibold text-slate-500">Tanggal Mulai</div>
                            <div class="mt-1 text-lg font-bold">
                                {{ \Illuminate\Support\Carbon::parse($draft['tanggal_mulai'])->format('d M Y') }}
                            </div>
                        </div>

                        <div class="rounded-xl bg-white p-4 text-center shadow-sm">
                            <div class="text-xs font-semibold text-slate-500">Tanggal Selesai</div>
                            <div class="mt-1 text-lg font-bold">
                                {{ \Illuminate\Support\Carbon::parse($draft['tanggal_selesai'])->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="/#kamar" class="text-sm font-semibold text-[#006a71] hover:underline">
                            ← Kembali pilih kamar
                        </a>
                    </div>
                </div>

                {{-- FORM PEMBAYARAN --}}
                <form method="POST"
                      action="{{ route('penyewa.pembayaran.store') }}"
                      enctype="multipart/form-data"
                      class="mt-10 space-y-6">
                    @csrf

                    {{-- ✅ PILIH PEMBAYARAN (hanya pilih & lunas) --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Pilih Pembayaran</label>
                        <select id="pilih_pembayaran"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-[#006a71] focus:ring-4 focus:ring-[#006a71]/15"
                                data-nominal-lunas="{{ $nominalLunas }}">
                            <option value="" selected disabled>-- Pilih --</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                        <p class="mt-2 text-xs text-slate-500">
                            Pilih <b>Lunas</b> untuk mengisi otomatis jumlah & metode.
                        </p>
                    </div>

                    {{-- ⬇️ FIELD ASLI YANG DIKIRIM KE CONTROLLER --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Jumlah Bayar</label>
                        <input id="jumlah_bayar" type="number" step="0.01" name="jumlah_bayar" required
                               placeholder="Contoh: 1500000"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-[#006a71] focus:ring-4 focus:ring-[#006a71]/15">
                        <p class="mt-2 text-xs text-slate-500">
                            Isi sesuai nominal pembayaran kamu.
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran" required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 outline-none transition focus:border-[#006a71] focus:ring-4 focus:ring-[#006a71]/15">
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Bukti Pembayaran <span class="text-slate-400">(upload file)</span>
                        </label>

                        <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-4">
                            <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf"
                                   class="block w-full text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-white file:px-4 file:py-2 file:font-semibold file:text-slate-700 file:shadow hover:file:bg-slate-100">
                            <p class="mt-2 text-xs text-slate-500">Format: JPG/PNG/PDF, maksimal 2MB.</p>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full rounded-2xl bg-[#006a71] px-6 py-4 text-lg font-bold text-white shadow-lg shadow-[#006a71]/25 transition hover:-translate-y-0.5 hover:bg-[#005a60] active:translate-y-0">
                        Bayar
                    </button>

                    <p class="text-center text-xs text-slate-500">
                        Setelah mengirim pembayaran, status akan <b>“Sedang Ditinjau”</b> sampai diverifikasi admin.
                    </p>
                </form>
            </div>
        </div>
    </div>

    {{-- ✅ AUTO ISI SAAT PILIH "LUNAS" --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pilih  = document.getElementById('pilih_pembayaran');
            const tipe   = document.getElementById('tipe_pembayaran');
            const jumlah = document.getElementById('jumlah_bayar');
            const metode = document.getElementById('metode_pembayaran');
            const jenis  = document.getElementById('jenis_pembayaran');

            function autofill() {
                if (pilih.value === 'Lunas') {
                    const nominal = Number(pilih.dataset.nominalLunas || 0);

                    // auto isi (kecuali bukti pembayaran)
                    tipe.value = 'Pelunasan';
                    if (nominal > 0) jumlah.value = nominal;

                    metode.value = 'E-Wallet';

                    // opsional (kalau ga mau, hapus 1 baris ini)
                    if (jenis && !jenis.value) jenis.value = 'Pelunasan';
                }
            }

            pilih.addEventListener('change', autofill);
        });
    </script>
</x-public-layout>