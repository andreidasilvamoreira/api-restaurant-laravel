<?php

namespace Database\Seeders;

use App\Models\Mesa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mesas')->insert([
            ['numero' => 1, 'capacidade' => 4, 'status' => Mesa::STATUS_DISPONIVEL, 'restaurante_id' => 1],
            ['numero' => 2, 'capacidade' => 2, 'status' => Mesa::STATUS_DISPONIVEL, 'restaurante_id' => 1],
            ['numero' => 3, 'capacidade' => 6, 'status' => Mesa::STATUS_RESERVADA, 'restaurante_id' => 1],
        ]);
    }
}
