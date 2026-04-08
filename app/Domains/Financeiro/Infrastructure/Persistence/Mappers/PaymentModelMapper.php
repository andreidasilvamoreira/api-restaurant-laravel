<?php

namespace App\Domains\Financeiro\Infrastructure\Persistence\Mappers;

use App\Domains\Financeiro\Domain\Entities\Payment;
use App\Domains\Financeiro\Domain\Enums\PaymentOptions;
use App\Domains\Financeiro\Domain\Enums\PaymentStatus;
use App\Models\Pagamento;

class PaymentModelMapper
{
    public static function toEntity(Pagamento $model): Payment
    {
        return new Payment(
            id: $model->id,
            dataHora: \DateTimeImmutable::createFromMutable($model->data_hora),
            valor: $model->valor,
            formaPagamento: $model->forma_pagamento,
            statusPagamento: $model->status_pagamento,
            pedidoId: $model->pedido_id,
        );
    }

    public static function toArray(Pagamento $model): array
    {
        return [
            'id' => $model->id,
            'data_hora' => $model->data_hora,
            'valor' => $model->valor,
            'forma_pagamento' => $model->forma_pagamento,
            'status_pagamento' => $model->status_pagamento,
            'pedido_id' => $model->pedido_id,
        ];
    }

    public static function entityToArray(Payment $payment): array
    {
        return [
            'id' => $payment->getId(),
            'data_hora' => $payment->getDataHora(),
            'valor' => $payment->getValor(),
            'forma_pagamento' => $payment->getFormaPagamento(),
            'status_pagamento' => $payment->getStatusPagamento(),
            'pedido_id' => $payment->getPedidoId()
        ];
    }
}
