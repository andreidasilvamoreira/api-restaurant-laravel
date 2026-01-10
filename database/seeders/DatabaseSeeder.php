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
            ClienteSeeder::class,
            MesaSeeder::class,
            FuncionarioSeeder::class,
            CategoriaSeeder::class,
            FornecedorSeeder::class,
            ItemMenuSeeder::class,
            InventarioSeeder::class,
            PedidoSeeder::class,
            ItemPedidoSeeder::class,
            PagamentoSeeder::class,
            ReservaSeeder::class,
            AbreFechaSeeder::class,
        ]);
    }

}
