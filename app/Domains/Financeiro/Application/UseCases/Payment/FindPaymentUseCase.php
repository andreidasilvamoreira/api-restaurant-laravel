<?php

namespace App\Domains\Financeiro\Application\UseCases\Payment;

use App\Domains\Financeiro\Application\DTOs\Payment\PaymentOutput;
use App\Domains\Financeiro\Application\Mappers\PaymentMapper;
use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;

class FindPaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $repository
    ) {}
    public function execute(int $id): PaymentOutput
    {
        $payment = $this->repository->findOrFail($id);

        return PaymentMapper::toOutput($payment);
    }
}
