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
            ['nome'=>'Carne','unidade'=>'kg','quantidade_atual'=>50,'preco_custo'=>30,'restaurante_id'=>1,'fornecedor_id'=>1],
            ['nome'=>'Refrigerante','unidade'=>'lata','quantidade_atual'=>100,'preco_custo'=>3,'restaurante_id'=>1,'fornecedor_id'=>2],
            ['nome'=>'Leite','unidade'=>'litro','quantidade_atual'=>20,'preco_custo'=>4,'restaurante_id'=>1,'fornecedor_id'=>3],
        ]);

    }
}
