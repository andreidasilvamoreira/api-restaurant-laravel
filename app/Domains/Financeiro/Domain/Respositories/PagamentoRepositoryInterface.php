<?php

namespace App\Domains\Financeiro\Domain\Respositories;

use App\Domains\Restaurant\Domain\Entities\Restaurant;
use App\Models\User;

interface PagamentoRepositoryInterface
{
    public function findVisibleByUser(User $user): array;
    public function findById(int $id): ?Restaurant;
    public function create(Restaurant $data): Restaurant;
    public function update(Restaurant $data): Restaurant;
    public function delete(int $id): void;
}
