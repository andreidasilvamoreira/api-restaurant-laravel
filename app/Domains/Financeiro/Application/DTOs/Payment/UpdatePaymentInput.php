<?php

namespace App\Domains\Financeiro\Application\DTOs\Payment;

class UpdatePaymentInput
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $dataHora,
        public readonly string $valor,
        public readonly string $formaPagamento,
        public readonly string $statusPagamento,
        public readonly int $pedidoId,
    ) {}
}
