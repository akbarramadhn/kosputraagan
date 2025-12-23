<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pembayaran')->insert([
            'id_sewa' => 1,
            'tanggal_pembayaran' => now(),
            'jumlah_bayar' => 1200000,
            'metode_pembayaran' => 'Transfer Bank',
            'status_pembayaran' => 'Terverifikasi',
            'tipe_pembayaran' => 'Sewa Baru',
        ]);
    }
}