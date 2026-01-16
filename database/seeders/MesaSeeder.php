<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mesas')->insert([
            ['numero' => 1, 'capacidade' => 4, 'status' => 'disponivel', 'restaurante_id' => 1],
            ['numero' => 2, 'capacidade' => 2, 'status' => 'disponivel', 'restaurante_id' => 1],
            ['numero' => 3, 'capacidade' => 6, 'status' => 'reservada', 'restaurante_id' => 1],
        ]);
    }
}
