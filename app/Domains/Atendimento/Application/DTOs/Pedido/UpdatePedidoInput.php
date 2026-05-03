<?php

namespace App\Domains\Atendimento\Application\DTOs\Pedido;

class UpdatePedidoInput
{
    public function __construct(
        public readonly int $id,
        public readonly array $changes,
    ) {}
}
