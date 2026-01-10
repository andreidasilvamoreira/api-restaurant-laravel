<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pedidos')->insert([
            ['data_hora'=>now(),'status_pedido'=>'aberto','cliente_id'=>1,'mesa_id'=>1,'funcionario_id'=>1],
            ['data_hora'=>now(),'status_pedido'=>'fechado','cliente_id'=>2,'mesa_id'=>2,'funcionario_id'=>2],
            ['data_hora'=>now(),'status_pedido'=>'pago','cliente_id'=>3,'mesa_id'=>3,'funcionario_id'=>3],
        ]);
    }
}
