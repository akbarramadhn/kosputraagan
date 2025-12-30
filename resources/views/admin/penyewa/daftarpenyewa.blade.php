@extends('layouts.admin')

@section('page-title', 'Data Penyewa')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 w-full">

        <div class="overflow-hidden border border-gray-200 rounded-sm">
            <table class="w-full text-left">
                <thead class="bg-teal-500">
                    <tr class="text-white">
                        <th class="px-6 py-4 font-semibold text-center whitespace-nowrap">Id Penyewa</th>
                        <th class="px-6 py-4 font-semibold text-center">Nama</th>
                        <th class="px-6 py-4 font-semibold text-center whitespace-nowrap">No Telp</th>
                        <th class="px-6 py-4 font-semibold text-center">Email</th>
                    </tr>
                </thead>

                <tbody class="bg-[#f3f0ea]">
                    @forelse($penyewas as $p)
                        <tr class="border-b border-gray-200 last:border-none">
                            <td class="px-6 py-5 text-center">{{ $p->id_penyewa }}</td>
                            <td class="px-6 py-5 text-center">{{ $p->user->name ?? '-' }}</td>
                            <td class="px-6 py-5 text-center">{{ $p->no_telp_penyewa ?? '-' }}</td>
                            <td class="px-6 py-5 text-center">{{ $p->user->email ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-600">
                                Belum ada data penyewa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-center">
            {{ $penyewas->links() }}
        </div>

    </div>
@endsection