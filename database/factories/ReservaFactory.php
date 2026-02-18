<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Mesa;
use App\Models\Restaurante;
use Illuminate\Database\Eloquent\Factories\Factory;
class ReservaFactory extends Factory
{

    public function definition(): array
    {
        return [
            'data_reserva' => $this->faker->date(now()->addDays(1)),
            'numero_pessoas' => $this->faker->numberBetween(1, 8),
            'status' => $this->faker->randomElement(['cancelado','confirmada','finalizada','pendente']),
            'mesa_id' => Mesa::factory(),
            'restaurante_id' => Restaurante::factory(),
            'cliente_id' => Cliente::factory(),
        ];
    }
}
