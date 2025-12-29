<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyewaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penyewa')->insert([
            [
                'user_id' => 4,
                'no_telp_penyewa' => '082345678901',
                'status_akun' => 'Terverifikasi',
            ],
            [
                'user_id' => 5,
                'no_telp_penyewa' => '089172348112',
                'status_akun' => 'Terverifikasi',
            ],
        ]);
    }
}