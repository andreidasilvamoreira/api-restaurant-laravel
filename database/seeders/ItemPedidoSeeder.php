<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemPedidoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('itens_pedido')->insert([
            [
                'pedido_id' => 1,
                'item_menu_id' => 2,
                'quantidade' => 2,
                'preco_unitario' => 25,
                'observacoes' => 'Sem cebola',
            ],
            [
                'pedido_id' => 2,
                'item_menu_id' => 1,
                'quantidade' => 3,
                'preco_unitario' => 6.50,
                'observacoes' => null,
            ],
            [
                'pedido_id' => 3,
                'item_menu_id' => 3,
                'quantidade' => 1,
                'preco_unitario' => 10,
                'observacoes' => 'Bem gelado',
            ],
        ]);

    }
}

