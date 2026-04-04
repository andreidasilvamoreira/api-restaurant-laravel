<?php

namespace App\Domains\Financeiro\Domain\Enums;

enum PaymentOptions: string
{
    case PAYMENT_PIX = 'pix';
    case PAYMENT_CARTAO_CREDITO = 'cartao_credito';
    case PAYMENT_CARTAO_DEBITO = 'cartao_debito';
    case PAYMENT_DINHEIRO = 'dinheiro';
}
