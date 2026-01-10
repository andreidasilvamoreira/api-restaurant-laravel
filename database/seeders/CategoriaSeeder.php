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
            ['nome'=>'Bebidas','descricao'=>'Bebidas em geral'],
            ['nome'=>'Pratos','descricao'=>'Pratos principais'],
            ['nome'=>'Sobremesas','descricao'=>'Doces'],
        ]);
    }
}
