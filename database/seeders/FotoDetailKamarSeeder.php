<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;
use App\Models\FotoDetailKamar;

class FotoDetailKamarSeeder extends Seeder
{
    public function run(): void
    {
        $kamars = Kamar::all();

        foreach ($kamars as $kamar) {

            FotoDetailKamar::create([
                'no_kamar' => $kamar->no_kamar,
                'foto_path' => 'kamar/kamar_' . $kamar->no_kamar . '_2.jpg',
            ]);
        }
    }
}
