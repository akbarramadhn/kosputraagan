<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // insert user admin
        $userId = DB::table('users')->insertGetId([
            'name' => 'Admin Kos',
            'email' => 'admin2@kos.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // insert detail admin
        DB::table('admin')->insert([
            'user_id' => $userId,
            'no_telp_admin' => '081234567890',
        ]);
    }
}