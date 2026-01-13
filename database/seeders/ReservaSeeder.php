<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservas')->insert([
            [
                'data_reserva' => now(),
                'numero_pessoas' => 4,
                'status' => 'confirmada',
                'mesa_id' => 1,
                'restaurante_id' => 1,
                'user_id' => 1,
            ],
            [
                'data_reserva' => now()->addDay(),
                'numero_pessoas' => 2,
                'status' => 'pendente',
                'mesa_id' => 2,
                'restaurante_id' => 1,
                'user_id' => 2,
            ],
            [
                'data_reserva' => now()->addDays(2),
                'numero_pessoas' => 6,
                'status' => 'finalizada',
                'mesa_id' => 3,
                'restaurante_id' => 2,
                'user_id' => 3,
            ],
        ]);

    }
}
