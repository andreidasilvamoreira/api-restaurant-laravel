<?php

namespace App\Domains\Inventory\Application\UseCases\Inventory;

use App\Domains\Inventory\Domain\Repositories\InventoryRepositoryInterface;

class DeleteInventoryUseCase
{
    public function __construct( protected InventoryRepositoryInterface $repository ) {}

    public function execute(int $id): void
    {
        $this->repository->findOrFail($id);
        $this->repository->delete($id);
    }
}
