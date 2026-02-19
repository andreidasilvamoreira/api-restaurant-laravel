<?php

namespace Database\Seeders;

use App\Models\ItemMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemMenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('itens_menu')->insert([
            ['nome'=>'Coca-Cola','descricao'=>'Refrigerante','preco'=>6.50,'disponibilidade'=> ItemMenu::DISPONIBILIDADE_DISPONIVEL,'categoria_id'=>1],
            ['nome'=>'Hambúrguer','descricao'=>'Carne bovina','preco'=>25.00,'disponibilidade'=> ItemMenu::DISPONIBILIDADE_DISPONIVEL,'categoria_id'=>2],
            ['nome'=>'Pudim','descricao'=>'Sobremesa','preco'=>10.00,'disponibilidade'=> ItemMenu::DISPONIBILIDADE_DISPONIVEL,'categoria_id'=>3],
        ]);
    }
}
