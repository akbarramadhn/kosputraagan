<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            [
                'user_id' => 1,
                'no_telp_admin' => '081234567890',
            ],
            [
                'user_id' => 2,
                'no_telp_admin' => '081298765432',
            ],
            [
                'user_id' => 3,
                'no_telp_admin' => '082112223333',
            ],
        ]);
    }
}
