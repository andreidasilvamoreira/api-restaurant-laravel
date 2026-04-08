<?php

namespace App\Domains\Financeiro\Application\Mappers;

use App\Domains\Financeiro\Application\DTOs\Payment\CreatePaymentInput;
use App\Domains\Financeiro\Application\DTOs\Payment\PaymentOutput;
use App\Domains\Financeiro\Domain\Entities\Payment;

class PaymentMapper
{
    public static function toEntity(CreatePaymentInput $input): Payment
    {
        return new Payment(
            id: null,
            dataHora: new \DateTimeImmutable($input->dataHora),
            valor: $input->valor,
            formaPagamento: $input->formaPagamento,
            statusPagamento: $input->statusPagamento,
            pedidoId: $input->pedidoId,
        );
    }

    public static function toOutput(Payment $payment): PaymentOutput
    {
        return new PaymentOutput(
            id: $payment->getId(),
            dataHora: $payment->getDataHora()->format('Y-m-d H:i:s'),
            valor: $payment->getValor(),
            formaPagamento: $payment->getFormaPagamento()->value,
            statusPagamento: $payment->getStatusPagamento()->value,
            pedidoId: $payment->getPedidoId()
        );
    }
}
