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
                'name' => 'Admin Kos',
                'email' => 'admin@kos.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Penyewa Umum',
                'email' => 'penyewa@kos.com',
                'password' => Hash::make('password'),
                'role' => 'penyewa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Penyewa Umum 2',
                'email' => 'penyewa2@kos.com',
                'password' => Hash::make('password'),
                'role' => 'penyewa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}