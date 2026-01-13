<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RestauranteSeeder::class,
            RestauranteUserSeeder::class,
            ClienteSeeder::class,
            FornecedorSeeder::class,
            CategoriaSeeder::class,
            MesaSeeder::class,
            ItemMenuSeeder::class,
            InventarioSeeder::class,
            ItemMenuInventarioSeeder::class,
            PedidoSeeder::class,
            ItemPedidoSeeder::class,
            PagamentoSeeder::class,
            ReservaSeeder::class,
        ]);
    }
}
