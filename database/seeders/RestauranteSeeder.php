<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestauranteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurantes')->insert([
            [
                'nome' => 'Restaurante Central',
                'descricao' => 'Unidade principal',
                'ativo' => true,
            ],
            [
                'nome' => 'Restaurante Norte',
                'descricao' => 'Unidade zona norte',
                'ativo' => true,
            ],
            [
                'nome' => 'Restaurante Sul',
                'descricao' => 'Unidade zona sul',
                'ativo' => true,
            ],
        ]);

    }
}
