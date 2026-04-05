<?php

namespace App\Domains\Financeiro\Domain\Enums;

enum PaymentStatus: string
{
     case PENDING = 'pendente';
     case CONFIRMED = 'confirmado';
     case CANCELED = 'cancelado';
}
