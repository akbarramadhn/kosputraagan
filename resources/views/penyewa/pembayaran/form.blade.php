<x-public-layout>
    <div class="min-h-[calc(100vh-120px)] bg-[#f6f3eb] py-16">
        <div class="mx-auto w-full max-w-md px-4">
            <div class="rounded-3xl bg-white p-6 sm:p-8 border border-slate-200 shadow-xl">
                
                <h1 class="text-center text-2xl font-extrabold tracking-tight text-slate-800">
                    Form <span class="text-[#006a71]">Pembayaran</span>
                </h1>

                <p class="mt-2 text-center text-sm text-slate-500">
                    Lengkapi pembayaran untuk melanjutkan proses sewa kamar.
                </p>

                {{-- FORM --}}
                <form method="POST"
                      action="{{ route('penyewa.pembayaran.store') }}"
                      enctype="multipart/form-data"
                      class="mt-6 space-y-5">
                    @csrf

                    {{-- PILIH PEMBAYARAN --}}
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">
                            Pilih Pembayaran
                        </label>
                        <select id="pilih_pembayaran"
                                name="tipe_pembayaran"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:border-[#006a71] focus:ring-4 focus:ring-[#006a71]/15">
                            <option value="" selected disabled>-- Pilih --</option>
                            <option value="Pelunasan">Lunas</option>
                        </select>
                    </div>

                    {{-- JUMLAH BAYAR --}}
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">
                            Jumlah Bayar
                        </label>
                        <input id="jumlah_bayar"
                               type="number"
                               step="0.01"
                               name="jumlah_bayar"
                               required
                               class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-[#006a71] focus:ring-4 focus:ring-[#006a71]/15">
                    </div>

                    {{-- METODE --}}
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">
                            Metode Pembayaran
                        </label>
                        <select id="metode_pembayaran"
                                name="metode_pembayaran"
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
                               class="block w-full text-sm text-slate-600">
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-[#006a71] py-3 text-sm font-bold text-white shadow-md hover:bg-[#005a60] transition">
                        Bayar
                    </button>
                </form>

            </div>
        </div>
    </div>

    {{-- AUTO ISI --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const HARGA_KAMAR = Number(@json($hargaKamar));
            const pilih = document.getElementById('pilih_pembayaran');
            const jumlah = document.getElementById('jumlah_bayar');

            if (!pilih || !jumlah) return;

            pilih.addEventListener('change', () => {
                if (pilih.value === 'Pelunasan') {
                    jumlah.value = HARGA_KAMAR;
                }
            });
        });
    </script>
    @endpush
</x-public-layout>