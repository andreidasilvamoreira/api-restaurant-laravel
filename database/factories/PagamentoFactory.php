<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pagamento>
 */
class PagamentoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'data_hora' => $this->faker->date(),
            'valor' => $this->faker->numberBetween($min = 1000, $max = 20000),
            'forma_pagamento' => $this->faker->randomElement(['pix','cartao_credito','cartao_debito','dinheiro']),
            'status_pagamento' => $this->faker->randomElement(['pendente', 'confirmado','cancelado']),
            'pedido_id' => Pedido::factory()
        ];
    }
}
