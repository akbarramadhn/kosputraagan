<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('feedback')->insert([
            'id_penyewa' => 1,
            'no_kamar' => 2,
            'tanggal_feedback' => now(),
            'isi_feedback' => 'AC kurang dingin',
            'status_feedback' => 'Belum Dibaca',
        ]);
    }
}