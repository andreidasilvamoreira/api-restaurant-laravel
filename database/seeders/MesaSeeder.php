<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mesas')->insert([
            ['numero'=>1,'capacidade'=>4,'status'=>'disponivel'],
            ['numero'=>2,'capacidade'=>2,'status'=>'ocupada'],
            ['numero'=>3,'capacidade'=>6,'status'=>'reservada'],
        ]);
    }
}
