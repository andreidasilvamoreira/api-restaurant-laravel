<?php

namespace App\Domains\Financeiro\Application\UseCases\Payment;

use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;

class DeletePaymentUseCase
{
    public function __construct(protected PaymentRepositoryInterface $repository) {}
    public function execute(int $id): void
    {
        $this->repository->findOrFail($id);
        $this->repository->delete($id);
    }
}
