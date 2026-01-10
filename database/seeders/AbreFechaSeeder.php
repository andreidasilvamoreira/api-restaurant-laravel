<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbreFechaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('abre_fecha')->insert([
            ['total_pedidos'=>5,'hora_abertura'=>'10:00:00','hora_fechamento'=>'14:00:00','mesa_id'=>1,'pedido_id'=>1],
            ['total_pedidos'=>3,'hora_abertura'=>'18:00:00','hora_fechamento'=>'22:00:00','mesa_id'=>2,'pedido_id'=>2],
            ['total_pedidos'=>7,'hora_abertura'=>'12:00:00','hora_fechamento'=>'16:00:00','mesa_id'=>3,'pedido_id'=>3],
        ]);
    }
}
