<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemMenuInventarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('item_menu_inventario')->insert([
            ['item_menu_id'=>1,'inventario_id'=>2,'quantidade_necessaria'=>1],
            ['item_menu_id'=>2,'inventario_id'=>1,'quantidade_necessaria'=>0.3],
            ['item_menu_id'=>3,'inventario_id'=>3,'quantidade_necessaria'=>0.2],
        ]);

    }
}
