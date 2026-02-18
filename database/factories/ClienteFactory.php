<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'telefone' => '62999998888',
            'endereco' => $this->faker->address(),
            'user_id' => User::factory()
        ];
    }
}
