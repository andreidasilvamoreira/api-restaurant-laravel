<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use App\Models\Restaurante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'unidade_medida' => $this->faker->randomElement(['kg', 'lata', 'litro']),
            'preco_custo' => $this->faker->numberBetween(1, 1000),
            'quantidade_atual' => $this->faker->numberBetween(1, 10000),
            'fornecedor_id' => Fornecedor::factory(),
            'restaurante_id' => Restaurante::factory(),
        ];
    }
}
