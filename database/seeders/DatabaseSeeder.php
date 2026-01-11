<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            PenyewaSeeder::class,
            KamarSeeder::class,
            SewaSeeder::class,
            PembayaranSeeder::class,
            FeedbackSeeder::class,
            InfoKosSeeder::class,
        ]);
    }
}
