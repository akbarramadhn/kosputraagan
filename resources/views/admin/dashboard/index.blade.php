@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-[#f3efe6] rounded-xl p-6 text-center shadow">
        <h3 class="text-lg font-semibold">Jumlah Kos</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $jumlahKamar }}</p>
    </div>

    <div class="bg-[#f3efe6] rounded-xl p-6 text-center shadow">
        <h3 class="text-lg font-semibold">Jumlah Penyewa</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $jumlahPenyewa }}</p>
    </div>

    <div class="bg-[#f3efe6] rounded-xl p-6 text-center shadow">
        <h3 class="text-lg font-semibold">Jumlah Keluhan</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $jumlahKeluhan }}</p>
    </div>

</div>

{{-- Grafik Sewa --}}
<div class="bg-white mt-10 p-8 rounded-lg shadow max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 text-center">Grafik Jumlah Sewa per Bulan</h2>

    <div class="mb-6 text-center">
        <label class="mr-2 font-medium">Pilih Tahun:</label>
        <select id="tahunSelect" class="border rounded px-3 py-1">
            @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                <option value="{{ $y }}">{{ $y }}</option>
            @endfor
        </select>
    </div>

    {{-- Ukuran grafik proporsional --}}
    <div class="relative w-full h-[280px]">
        <canvas id="chartSewa"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const bulanLabel = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    const dataSewa = @json($jumlahPerBulan);

    const ctx = document.getElementById('chartSewa').getContext('2d');

    const chartSewa = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bulanLabel,
            datasets: [
                {
                    label: 'Jumlah Sewa per Bulan',
                    data: dataSewa,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Grafik Garis',
                    type: 'line',
                    data: dataSewa,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'transparent',
                    tension: 0.3,
                    pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 6, // batas atas sumbu Y jadi 6
                    ticks: {
                        stepSize: 1
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Sewa'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 20,
                        padding: 15
                    }
                }
            }
        }
    });
</script>
@endsection
