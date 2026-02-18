<?php

namespace Database\Factories;

use App\Models\Mesa;
use App\Models\Restaurante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mesa>
 */
class MesaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'numero' => $this->faker->unique()->randomNumber(),
 feature/automated-tests
            'capacidade' => $this->faker->numberBetween(1,8),
            'status' => fake()->randomElement(['disponivel', 'ocupada', 'reservada',]),
            'restaurante_id' => Restaurante::factory()

            'capacidade' => $this->faker->randomNumber(),
            'status' => fake()->randomElement(['disponivel', 'ocupada', 'reservada',]),
            'restaurante_id' => Restaurante::factory()->create()
 main
        ];
    }
}
