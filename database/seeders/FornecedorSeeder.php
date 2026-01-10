<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fornecedores')->insert([
            ['nome'=>'Fornecedor A','telefone'=>'111','email'=>'a@forn.com','endereco'=>'Rua X'],
            ['nome'=>'Fornecedor B','telefone'=>'222','email'=>'b@forn.com','endereco'=>'Rua Y'],
            ['nome'=>'Fornecedor C','telefone'=>'333','email'=>'c@forn.com','endereco'=>'Rua Z'],
        ]);
    }
}
