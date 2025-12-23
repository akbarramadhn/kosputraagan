<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoKosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('info_kos')->insert([
            [
                'gambar' => 'parkir.jpg',
                'keterangan' => 'Area Parkir',
                'deskripsi' => 'Parkiran luas dan aman',
                'kategori' => 'Fasilitas',
            ],
            [
                'gambar' => 'wifi.jpg',
                'keterangan' => 'WiFi',
                'deskripsi' => 'WiFi cepat 24 jam',
                'kategori' => 'Fasilitas',
            ],
        ]);
    }
}