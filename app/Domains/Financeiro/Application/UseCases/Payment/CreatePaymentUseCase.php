<?php

namespace App\Domains\Financeiro\Application\UseCases\Payment;

use App\Domains\Financeiro\Application\DTOs\Payment\CreatePaymentInput;
use App\Domains\Financeiro\Application\DTOs\Payment\PaymentOutput;
use App\Domains\Financeiro\Domain\Entities\Payment;
use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;

class CreatePaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $repository
    ) {}

    public function execute(CreatePaymentInput $input): PaymentOutput
    {
        $payment = new Payment(
            id: null,
            dataHora: new \DateTimeImmutable($input->dataHora),
            valor: $input->valor,
            formaPagamento: $input->formaPagamento,
            statusPagamento: $input->statusPagamento,
            pedidoId: $input->pedidoId
        );

        $payment = $this->repository->create($payment);

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
