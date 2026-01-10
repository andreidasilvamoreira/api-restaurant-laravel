<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagamentoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pagamentos')->insert([
            ['data_hora'=>now(),'valor'=>50,'forma_pagamento'=>'cartao','status_pagamento'=>'confirmado','pedido_id'=>1],
            ['data_hora'=>now(),'valor'=>6.5,'forma_pagamento'=>'dinheiro','status_pagamento'=>'confirmado','pedido_id'=>2],
            ['data_hora'=>now(),'valor'=>30,'forma_pagamento'=>'pix','status_pagamento'=>'pendente','pedido_id'=>3],
        ]);
    }
}
