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
            ['quantidade'=>2,'preco_unitario'=>25,'observacoes'=>'Sem cebola','pedido_id'=>1,'item_menu'=>2,'inventario_id'=>1],
            ['quantidade'=>1,'preco_unitario'=>6.5,'observacoes'=>'Gelada','pedido_id'=>2,'item_menu'=>1,'inventario_id'=>2],
            ['quantidade'=>3,'preco_unitario'=>10,'observacoes'=>'','pedido_id'=>3,'item_menu'=>3,'inventario_id'=>3],
        ]);
    }
}

