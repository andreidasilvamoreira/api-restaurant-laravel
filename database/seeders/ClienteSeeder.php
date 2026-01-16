<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'user_id' => 1,
                'telefone' => '11999999999',
                'endereco' => 'Rua A, 123',
            ],
            [
                'user_id' => 2,
                'telefone' => '11888888888',
                'endereco' => 'Rua B, 456',
            ],
            [
                'user_id' => 3,
                'telefone' => '11777777777',
                'endereco' => 'Rua C, 789',
            ],
        ]);

    }
}
