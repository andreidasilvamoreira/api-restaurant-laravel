<?php

namespace App\Domains\Financeiro\Application\UseCases\Payment;

use App\Domains\Financeiro\Application\DTOs\Payment\PaymentOutput;
use App\Domains\Financeiro\Application\DTOs\Payment\UpdatePaymentInput;
use App\Domains\Financeiro\Domain\Entities\Payment;
use App\Domains\Financeiro\Domain\Enums\PaymentOptions;
use App\Domains\Financeiro\Domain\Enums\PaymentStatus;
use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;

class UpdatePaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $repository
    ) {}

    public function execute(UpdatePaymentInput $data): PaymentOutput
    {
        $payment = $this->repository->findOrFail($data->id);

        if ($data->dataHora !== null) {
            $payment->setDataHora(new \DateTimeImmutable($data->dataHora));
        }

        if ($data->valor !== null) {
            $payment->setValor($data->valor);
        }

        if ($data->formaPagamento !== null) {
            $payment->setFormaPagamento(PaymentOptions::from($data->formaPagamento));
        }

        if ($data->statusPagamento !== null) {
            $payment->setStatusPagamento(PaymentStatus::from($data->statusPagamento));
        }

        if ($data->pedidoId !== null) {
            $payment->setPedidoId($data->pedidoId);
        }

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
