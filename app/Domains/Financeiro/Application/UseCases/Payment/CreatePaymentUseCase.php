<?php

namespace App\Domains\Financeiro\Application\UseCases\Payment;

use App\Domains\Financeiro\Application\DTOs\Payment\CreatePaymentInput;
use App\Domains\Financeiro\Application\DTOs\Payment\PaymentOutput;
use App\Domains\Financeiro\Application\Mappers\PaymentMapper;
use App\Domains\Financeiro\Domain\Entities\Payment;
use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;

class CreatePaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $repository
    ) {}

    public function execute(CreatePaymentInput $input): PaymentOutput
    {
        $payment = PaymentMapper::toEntity($input);

        $payment = $this->repository->create($payment);

        return PaymentMapper::toOutput($payment);
    }
}
