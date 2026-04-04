<?php

namespace App\Domains\Financeiro\Domain\Enums;

enum PaymentStatus: string
{
    public const STATUS_PAGAMENTO_PENDENTE = 'pendente';
    public const STATUS_PAGAMENTO_CONFIRMADO = 'confirmado';
    public const STATUS_PAGAMENTO_CANCELADO = 'cancelado';
}
