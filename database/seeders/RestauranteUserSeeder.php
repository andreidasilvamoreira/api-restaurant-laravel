<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestauranteUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('restaurante_users')->insert([
            ['user_id' => 1, 'restaurante_id' => 1, 'role' => 'CLIENTE'],
            ['user_id' => 2, 'restaurante_id' => 1, 'role' => 'ATENDENTE'],
            ['user_id' => 3, 'restaurante_id' => 1, 'role' => 'ADMIN'],
            ['user_id' => 1, 'restaurante_id' => 2, 'role' => 'CLIENTE'],
            ['user_id' => 2, 'restaurante_id' => 2, 'role' => 'ATENDENTE'],
            ['user_id' => 3, 'restaurante_id' => 3, 'role' => 'ADMIN'],
        ]);

    }
}
