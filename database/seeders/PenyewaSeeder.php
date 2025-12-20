<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenyewaSeeder extends Seeder
{
    public function run(): void
    {
        // insert user penyewa
        $userId = DB::table('users')->insertGetId([
            'name' => 'Penyewa Umum',
            'email' => 'penyewa2@kos.com',
            'password' => Hash::make('penyewa123'),
            'role' => 'penyewa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // insert detail penyewa
        DB::table('penyewa')->insert([
            'user_id' => $userId,
            'no_telp_penyewa' => '082345678901',
            'status_akun' => 'Terverifikasi',
        ]);
    }
}