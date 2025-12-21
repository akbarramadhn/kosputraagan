<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Tambah Kamar
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form action="{{ route('admin.kamar.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf

            <div>
                <label>Tipe Kamar</label>
                <select name="tipe_kamar" class="w-full border rounded p-2">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>

            <div>
                <label>Harga / Bulan</label>
                <input type="number" name="harga_perbulan"
                       class="w-full border rounded p-2">
            </div>

            <div>
                <label>Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="Kosong">Kosong</option>
                    <option value="Isi">Isi</option>
                </select>
            </div>

            <div>
                <label>Fasilitas</label>
                <textarea name="fasilitas"
                          class="w-full border rounded p-2"></textarea>
            </div>

            <div>
                <label>Deskripsi</label>
                <textarea name="deskripsi"
                          class="w-full border rounded p-2"></textarea>
            </div>

            <div>
                <label>Foto Kamar</label>
                <input type="file" name="foto_kos"
                       class="w-full border rounded p-2">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>