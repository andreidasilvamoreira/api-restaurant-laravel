<?php

namespace App\Domains\Financeiro\Domain\Enums;

enum PaymentOptions: string
{
    case PIX = 'pix';
    case CREDIT_CARD = 'cartao_credito';
    case DEBIT_CARD = 'cartao_debito';
    case MONEY = 'dinheiro';
}
