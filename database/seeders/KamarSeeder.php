<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kamar')->insert([
            [
                'foto_kos' => 'foto1.jpg',
                'tipe_kamar' => 'A',
                'harga_perbulan' => 1500000,
                'status' => 'Kosong',
                'deskripsi' => 'Kamar nyaman dengan AC',
                'fasilitas' => 'AC, WiFi'
            ]
        ]);
    }
}
