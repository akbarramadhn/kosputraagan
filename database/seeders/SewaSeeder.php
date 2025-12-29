<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SewaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sewa')->insert([
            [
                'id_penyewa' => 1,
                'no_kamar' => 1,
                'tanggal_mulai' => Carbon::parse('2024-01-01'),
                'tanggal_selesai' => Carbon::parse('2024-03-01'),
                'status_sewa' => 'Selesai',
                'tanggal_selesai_lama' => Carbon::parse('2024-03-01'),
            ],
            [
                'id_penyewa' => 2,
                'no_kamar' => 2,
                'tanggal_mulai' => Carbon::parse('2024-02-01'),
                'tanggal_selesai' => Carbon::parse('2024-04-01'),
                'status_sewa' => 'Selesai',
                'tanggal_selesai_lama' => Carbon::parse('2024-04-01'),
            ],
            [
                'id_penyewa' => 1,
                'no_kamar' => 3,
                'tanggal_mulai' => Carbon::parse('2024-03-01'),
                'tanggal_selesai' => Carbon::parse('2024-05-01'),
                'status_sewa' => 'Selesai',
                'tanggal_selesai_lama' => Carbon::parse('2024-05-01'),
            ],
            [
                'id_penyewa' => 2,
                'no_kamar' => 1,
                'tanggal_mulai' => Carbon::parse('2024-04-01'),
                'tanggal_selesai' => Carbon::parse('2024-06-01'),
                'status_sewa' => 'Selesai',
                'tanggal_selesai_lama' => Carbon::parse('2024-06-01'),
            ],
            [
                'id_penyewa' => 1,
                'no_kamar' => 2,
                'tanggal_mulai' => Carbon::parse('2024-05-01'),
                'tanggal_selesai' => Carbon::parse('2024-07-01'),
                'status_sewa' => 'Selesai',
                'tanggal_selesai_lama' => Carbon::parse('2024-07-01'),
            ],
            [
                'id_penyewa' => 2,
                'no_kamar' => 3,
                'tanggal_mulai' => Carbon::parse('2024-06-01'),
                'tanggal_selesai' => Carbon::parse('2024-08-01'),
                'status_sewa' => 'Selesai',
                'tanggal_selesai_lama' => Carbon::parse('2024-08-01'),
            ],
            [
                'id_penyewa' => 2,
                'no_kamar' => 1,
                'tanggal_mulai' => Carbon::parse('2024-09-01'),
                'tanggal_selesai' => Carbon::parse('2024-12-01'),
                'status_sewa' => 'Selesai',
                'tanggal_selesai_lama' => Carbon::parse('2024-12-01'),
            ],
            [
                'id_penyewa' => 1,
                'no_kamar' => 2,
                'tanggal_mulai' => Carbon::parse('2025-01-01'),
                'tanggal_selesai' => Carbon::parse('2025-03-01'),
                'status_sewa' => 'Selesai',
                'tanggal_selesai_lama' => Carbon::parse('2025-03-01'),
            ],
            [
                'id_penyewa' => 1,
                'no_kamar' => 3,
                'tanggal_mulai' => Carbon::now()->subMonth(),
                'tanggal_selesai' => Carbon::now()->addMonth(),
                'status_sewa' => 'Sewa',
                'tanggal_selesai_lama' => Carbon::now()->subMonth(),
            ],
            [
                'id_penyewa' => 2,
                'no_kamar' => 1,
                'tanggal_mulai' => Carbon::now()->subMonth(),
                'tanggal_selesai' => Carbon::now()->addMonth(),
                'status_sewa' => 'Sewa',
                'tanggal_selesai_lama' => Carbon::now()->subMonth(),
            ],
        ]);
    }
}