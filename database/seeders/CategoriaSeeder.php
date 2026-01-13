<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nome' => 'Bebidas', 'descricao' => 'Bebidas em geral', 'restaurante_id' => 1],
            ['nome' => 'Lanches', 'descricao' => 'Lanches artesanais', 'restaurante_id' => 2],
            ['nome' => 'Sobremesas', 'descricao' => 'Doces', 'restaurante_id' => 3],
        ]);

    }
}
