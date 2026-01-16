<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pedidos')->insert([
            [
                'status' => 'aberto',
                'restaurante_id' => 1,
                'user_id' => 1,
                'atendente_id' => 2,
                'mesa_id' => 1,
            ],
            [
                'status' => 'preparando',
                'restaurante_id' => 1,
                'user_id' => 1,
                'atendente_id' => 2,
                'mesa_id' => 2,
            ],
            [
                'status' => 'finalizado',
                'restaurante_id' => 2,
                'user_id' => 2,
                'atendente_id' => 2,
                'mesa_id' => 3,
            ],
        ]);

    }
}
