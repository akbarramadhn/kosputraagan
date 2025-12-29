<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Akbar Ramadhan',
                'email' => 'akbar@kos.com',
                'password' => Hash::make('akbar123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Hany Nadya',
                'email' => 'hany@kos.com',
                'password' => Hash::make('hany123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Bilqis',
                'email' => 'bilqis@kos.com',
                'password' => Hash::make('bilqis123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'cia bs',
                'email' => 'cia@kos.com',
                'password' => Hash::make('akbar123'),
                'role' => 'penyewa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Penyewa Baru',
                'email' => 'penyewa@kos.com',
                'password' => Hash::make('penyewa123'),
                'role' => 'penyewa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}