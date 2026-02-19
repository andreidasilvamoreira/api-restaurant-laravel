<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pedidos')->insert([
            [
                'status' => Pedido::STATUS_ABERTO,
                'restaurante_id' => 1,
                'atendente_id' => 2,
                'cliente_id' => 1,
                'mesa_id' => 1,
            ],
            [
                'status' => Pedido::STATUS_PREPARANDO,
                'restaurante_id' => 1,
                'atendente_id' => 2,
                'cliente_id' => 2,
                'mesa_id' => 2,
            ],
            [
                'status' => Pedido::STATUS_FINALIZADO,
                'restaurante_id' => 2,
                'atendente_id' => 2,
                'cliente_id' => 3,
                'mesa_id' => 3,
            ],
        ]);

    }
}
