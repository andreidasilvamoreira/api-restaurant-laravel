<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Mesa;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{

    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['aberto','preparando','finalizado','pago']),
            'data_hora' => $this->faker->date(),
            'cliente_id' => Cliente::factory(),
            'mesa_id' => Mesa::factory(),
            'atendente_id' => null,
            'restaurante_id' => Restaurante::factory(),
        ];
    }
}
