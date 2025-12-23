<?php

namespace Database\Seeders;

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
                'foto_kos'       => 'kamar_a1.jpg',
                'tipe_kamar'     => 'A',
                'harga_perbulan' => 1500000,
                'status'         => 'Kosong',
                'deskripsi'      => 'Kamar nyaman dengan AC dan pencahayaan baik',
                'fasilitas'      => 'AC, WiFi, Lemari'
            ],
            [
                'foto_kos'       => 'kamar_b1.jpg',
                'tipe_kamar'     => 'B',
                'harga_perbulan' => 1200000,
                'status'         => 'Isi',
                'deskripsi'      => 'Kamar standar cocok untuk mahasiswa',
                'fasilitas'      => 'Kipas, WiFi'
            ],
            [
                'foto_kos'       => 'kamar_c1.jpg',
                'tipe_kamar'     => 'C',
                'harga_perbulan' => 1800000,
                'status'         => 'Kosong',
                'deskripsi'      => 'Kamar luas dengan kamar mandi dalam',
                'fasilitas'      => 'AC, WiFi, KM Dalam'
            ]
        ]);
    }
}