<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\ItemMenu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemMenu>
 */
class ItemMenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'descricao' => $this->faker->text(),
            'preco' => $this->faker->randomFloat(2,1, 10000),
            'disponibilidade' => $this->faker->randomElement(ItemMenu::DISPONIBILIDADE),
            'categoria_id' => Categoria::factory()
        ];
    }
}
