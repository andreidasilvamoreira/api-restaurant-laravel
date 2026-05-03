<?php

namespace App\Domains\Atendimento\Application\DTOs\Pedido;

class CreatePedidoInput
{
    public function __construct(
        public readonly string $dataHora,
        public readonly string $status,
        public readonly int $clienteId,
        public readonly ?int $mesaId,
        public readonly int $restauranteId,
        public readonly ?int $atendenteId,
        public readonly array $itens = [],
    ) {}
}
