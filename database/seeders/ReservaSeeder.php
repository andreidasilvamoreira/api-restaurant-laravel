<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservas')->insert([
            ['data_hora'=>now(),'numero_pessoas'=>4,'status'=>'confirmada','cliente_id'=>1,'mesa_id'=>3],
            ['data_hora'=>now(),'numero_pessoas'=>2,'status'=>'cancelado','cliente_id'=>2,'mesa_id'=>2],
            ['data_hora'=>now(),'numero_pessoas'=>6,'status'=>'confirmada','cliente_id'=>3,'mesa_id'=>1],
        ]);
    }
}
