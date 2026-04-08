<?php

namespace App\Domains\Financeiro\Application\UseCases\Payment;

use App\Domains\Financeiro\Application\DTOs\Payment\PaymentOutput;
use App\Domains\Financeiro\Application\Mappers\PaymentMapper;
use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;
use App\Models\User;

class FindUserPaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $repository
    ) {}

    public function execute(User $user): array
    {
        $payment = $this->repository->findVisibleByUser($user);

        return array_map(
            fn($payment) => PaymentMapper::toOutput($payment),
            $payment
        );
    }
}
