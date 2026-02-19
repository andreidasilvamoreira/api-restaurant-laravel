<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestauranteUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('restaurante_users')->insert([
            ['user_id' => 1, 'restaurante_id' => 1, 'role' => 'CLIENTE', 'ativo' => true],
            ['user_id' => 2, 'restaurante_id' => 1, 'role' => 'FUNCIONARIO', 'ativo' => true],
            ['user_id' => 3, 'restaurante_id' => 1, 'role' => 'ADMIN', 'ativo' => false],
            ['user_id' => 1, 'restaurante_id' => 2, 'role' => 'CLIENTE', 'ativo' => false],
            ['user_id' => 2, 'restaurante_id' => 2, 'role' => 'FUNCIONARIO', 'ativo' => false],
            ['user_id' => 3, 'restaurante_id' => 3, 'role' => 'ADMIN', 'ativo' => true],
        ]);

    }
}
