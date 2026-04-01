<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestauranteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('restaurantes')->insert([
            [
                'nome' => 'Restaurant Central',
                'descricao' => 'Unidade principal',
                'ativo' => true,
            ],
            [
                'nome' => 'Restaurant Norte',
                'descricao' => 'Unidade zona norte',
                'ativo' => true,
            ],
            [
                'nome' => 'Restaurant Sul',
                'descricao' => 'Unidade zona sul',
                'ativo' => true,
            ],
        ]);

    }
}
