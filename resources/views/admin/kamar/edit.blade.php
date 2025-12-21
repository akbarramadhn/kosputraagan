<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Edit Kamar
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form action="{{ route('admin.kamar.update', $kamar) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Tipe Kamar</label>
                <select name="tipe_kamar" class="w-full border rounded p-2">
                    @foreach(['A','B','C'] as $tipe)
                        <option value="{{ $tipe }}"
                            @selected($kamar->tipe_kamar == $tipe)>
                            {{ $tipe }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Harga / Bulan</label>
                <input type="number" name="harga_perbulan"
                       value="{{ $kamar->harga_perbulan }}"
                       class="w-full border rounded p-2">
            </div>

            <div>
                <label>Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="Kosong" @selected($kamar->status=='Kosong')>Kosong</option>
                    <option value="Isi" @selected($kamar->status=='Isi')>Isi</option>
                </select>
            </div>

            <div>
                <label>Fasilitas</label>
                <textarea name="fasilitas"
                          class="w-full border rounded p-2">{{ $kamar->fasilitas }}</textarea>
            </div>

            <div>
                <label>Deskripsi</label>
                <textarea name="deskripsi"
                          class="w-full border rounded p-2">{{ $kamar->deskripsi }}</textarea>
            </div>

            <div>
                <label>Foto Baru (opsional)</label>
                <input type="file" name="foto_kos"
                       class="w-full border rounded p-2">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>