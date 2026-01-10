<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clientes')->insert([
            ['nome'=>'João Silva','telefone'=>'11999999999','endereco'=>'Rua A, 123','email'=>'joao@email.com'],
            ['nome'=>'Maria Souza','telefone'=>'11888888888','endereco'=>'Rua B, 456','email'=>'maria@email.com'],
            ['nome'=>'Carlos Lima','telefone'=>'11777777777','endereco'=>'Rua C, 789','email'=>'carlos@email.com'],
        ]);
    }
}
