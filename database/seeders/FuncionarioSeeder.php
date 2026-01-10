<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('funcionarios')->insert([
            ['nome'=>'Ana','cargo'=>'Garçonete','telefone'=>'111','email'=>'ana@rest.com','data_contratacao'=>'2023-01-10','salario'=>2200],
            ['nome'=>'Bruno','cargo'=>'Cozinheiro','telefone'=>'222','email'=>'bruno@rest.com','data_contratacao'=>'2022-06-01','salario'=>3000],
            ['nome'=>'Paulo','cargo'=>'Gerente','telefone'=>'333','email'=>'paulo@rest.com','data_contratacao'=>'2021-03-15','salario'=>4500],
        ]);
    }
}
