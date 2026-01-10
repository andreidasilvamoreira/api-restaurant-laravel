<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemMenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('itens_menu')->insert([
            ['nome'=>'Coca-Cola','descricao'=>'Refrigerante','preco'=>6.50,'disponibilidade'=>'disponivel','categoria_id'=>1],
            ['nome'=>'Hambúrguer','descricao'=>'Carne bovina','preco'=>25.00,'disponibilidade'=>'disponivel','categoria_id'=>2],
            ['nome'=>'Pudim','descricao'=>'Sobremesa','preco'=>10.00,'disponibilidade'=>'indisponivel','categoria_id'=>3],
        ]);
    }
}
