<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Kos',
                'email' => 'admin@kos.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penyewa Umum',
                'email' => 'penyewa@kos.com',
                'password' => bcrypt('password'),
                'role' => 'penyewa',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}