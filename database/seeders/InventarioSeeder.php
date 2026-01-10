<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inventarios')->insert([
            ['nome'=>'Carne','descricao'=>'Carne bovina','unidade'=>50,'preco_custado'=>20,'fornecedor_id'=>1],
            ['nome'=>'Refrigerante','descricao'=>'Lata','unidade'=>100,'preco_custado'=>3,'fornecedor_id'=>2],
            ['nome'=>'Açúcar','descricao'=>'Refinado','unidade'=>30,'preco_custado'=>4,'fornecedor_id'=>3],
        ]);
    }
}
