<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SewaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sewa')->insert([
            'id_penyewa' => 1,
            'no_kamar' => 2,
            'tanggal_mulai' => now()->subMonth(),
            'tanggal_selesai' => now()->addMonth(),
            'status_sewa' => 'Sewa',
        ]);
    }
}