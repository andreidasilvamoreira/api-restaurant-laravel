<?php

namespace App\Domains\Inventory\Domain\Repositories;

use App\Domains\Inventory\Domain\Entities\Inventory;
use App\Models\User;

interface InventoryRepositoryInterface
{
    public function findVisibleByUser(User $user): array;
    public function findById(int $id): ?Inventory;
    public function create(Inventory $inventory): Inventory;
    public function update(Inventory $inventory): Inventory;
    public function delete(int $id): void;
}
