<?php

namespace App\Domains\Financeiro\Domain\Repositories;

use App\Domains\Financeiro\Domain\Entities\Payment;
use App\Models\User;

interface PaymentRepositoryInterface
{
    public function findVisibleByUser(User $user): array;
    public function findById(int $id): ?Payment;
    public function create(Payment $data): Payment;
    public function update(Payment $data): Payment;
    public function delete(int $id): void;
}
