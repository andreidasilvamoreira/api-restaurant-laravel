<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fornecedores')->insert([
            ['nome'=>'Fornecedor A','telefone'=>'1111-1111','email'=>'a@email.com','endereco'=>'Rua X','restaurante_id'=>1],
            ['nome'=>'Fornecedor B','telefone'=>'2222-2222','email'=>'b@email.com','endereco'=>'Rua Y','restaurante_id'=>1],
            ['nome'=>'Fornecedor C','telefone'=>'3333-3333','email'=>'c@email.com','endereco'=>'Rua Z','restaurante_id'=>1],
        ]);

    }
}
