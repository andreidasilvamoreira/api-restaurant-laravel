<?php

namespace Database\Factories;

use App\Models\Restaurante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'descricao' => $this->faker->text(),
            'restaurante_id' => Restaurante::factory(),
        ];
    }
}
