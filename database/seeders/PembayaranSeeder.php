<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pembayaran')->insert([
            [
                'id_sewa' => 1,
                'tanggal_pembayaran' => now()->subMonths(9),
                'jumlah_bayar' => 1500000,
                'metode_pembayaran' => 'Transfer Bank',
                'status_pembayaran' => 'Terverifikasi',
                'tipe_pembayaran' => 'Sewa Baru',
            ],
            [
                'id_sewa' => 2,
                'tanggal_pembayaran' => now()->subMonths(8),
                'jumlah_bayar' => 1200000,
                'metode_pembayaran' => 'E-Wallet',
                'status_pembayaran' => 'Terverifikasi',
                'tipe_pembayaran' => 'Sewa Baru',
            ],
            [
                'id_sewa' => 3,
                'tanggal_pembayaran' => now()->subMonths(7),
                'jumlah_bayar' => 1100000,
                'metode_pembayaran' => 'Cash',
                'status_pembayaran' => 'Terverifikasi',
                'tipe_pembayaran' => 'Perpanjang',
            ],
            [
                'id_sewa' => 4,
                'tanggal_pembayaran' => now()->subMonths(6),
                'jumlah_bayar' => 1500000,
                'metode_pembayaran' => 'Transfer Bank',
                'status_pembayaran' => 'Terverifikasi',
                'tipe_pembayaran' => 'Perpanjang',
            ],
            [
                'id_sewa' => 5,
                'tanggal_pembayaran' => now()->subMonths(5),
                'jumlah_bayar' => 1200000,
                'metode_pembayaran' => 'E-Wallet',
                'status_pembayaran' => 'Terverifikasi',
                'tipe_pembayaran' => 'Perpanjang',
            ],
            [
                'id_sewa' => 6,
                'tanggal_pembayaran' => now()->subMonths(4),
                'jumlah_bayar' => 1100000,
                'metode_pembayaran' => 'Cash',
                'status_pembayaran' => 'Terverifikasi',
                'tipe_pembayaran' => 'Perpanjang',
            ],
            [
                'id_sewa' => 7,
                'tanggal_pembayaran' => now()->subMonths(3),
                'jumlah_bayar' => 1500000,
                'metode_pembayaran' => 'Transfer Bank',
                'status_pembayaran' => 'Sedang Ditinjau',
                'tipe_pembayaran' => 'Perpanjang',
            ],
            [
                'id_sewa' => 8,
                'tanggal_pembayaran' => now()->subMonths(2),
                'jumlah_bayar' => 1200000,
                'metode_pembayaran' => 'E-Wallet',
                'status_pembayaran' => 'Terverifikasi',
                'tipe_pembayaran' => 'Perpanjang',
            ],
            [
                'id_sewa' => 9,
                'tanggal_pembayaran' => now()->subMonth(),
                'jumlah_bayar' => 1100000,
                'metode_pembayaran' => 'Cash',
                'status_pembayaran' => 'Terverifikasi',
                'tipe_pembayaran' => 'Perpanjang',
            ],
            [
                'id_sewa' => 10,
                'tanggal_pembayaran' => now(),
                'jumlah_bayar' => 1500000,
                'metode_pembayaran' => 'Transfer Bank',
                'status_pembayaran' => 'Ditolak',
                'tipe_pembayaran' => 'Perpanjang',
            ],
        ]);
    }
}