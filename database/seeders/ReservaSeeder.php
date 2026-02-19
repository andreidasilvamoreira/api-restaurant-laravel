<?php

namespace Database\Seeders;

use App\Models\Reserva;
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
                'status' => Reserva::STATUS_RESERVA_CONFIRMADA,
                'mesa_id' => 1,
                'restaurante_id' => 1,
                'cliente_id' => 1,
            ],
            [
                'data_reserva' => now()->addDay(),
                'numero_pessoas' => 2,
                'status' => Reserva::STATUS_RESERVA_PENDENTE,
                'mesa_id' => 2,
                'restaurante_id' => 1,
                'cliente_id' => 2,
            ],
            [
                'data_reserva' => now()->addDays(2),
                'numero_pessoas' => 6,
                'status' => Reserva::STATUS_RESERVA_FINALIZADA,
                'mesa_id' => 3,
                'restaurante_id' => 2,
                'cliente_id' => 3,
            ],
        ]);

    }
}
