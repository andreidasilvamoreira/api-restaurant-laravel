<?php

namespace App\Domains\Inventory\Domain\Repositories;

use App\Domains\Inventory\Domain\Entities\Supplier;
use App\Models\User;

interface SupplierRepositoryInterface
{
    public function findVisibleByUser(User $user): array;
    public function findById(int $id): ?Supplier;
    public function create(Supplier $supplier): Supplier;
    public function update(Supplier $supplier): Supplier;
    public function delete(int $id): void;
}
