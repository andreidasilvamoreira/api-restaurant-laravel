<?php

namespace App\Domains\Atendimento\Application\DTOs\Pedido;

class PedidoOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $data_hora,
        public readonly string $status,
        public readonly int $cliente_id,
        public readonly ?int $mesa_id,
        public readonly int $restaurante_id,
        public readonly ?int $atendente_id,
        public readonly array $itens = [],
    ) {}
}
