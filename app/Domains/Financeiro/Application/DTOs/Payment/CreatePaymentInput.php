<?php

namespace App\Domains\Financeiro\Application\DTOs\Payment;

use App\Domains\Financeiro\Domain\Enums\PaymentOptions;
use App\Domains\Financeiro\Domain\Enums\PaymentStatus;

class CreatePaymentInput
{
    public function __construct(
        public readonly string $dataHora,
        public readonly string $valor,
        public readonly PaymentOptions $formaPagamento,
        public readonly PaymentStatus $statusPagamento,
        public readonly int $pedidoId,
    ) {}
}
