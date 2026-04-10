<?php

namespace App\Domains\Inventory\Application\UseCases\Supplier;

use App\Domains\Inventory\Domain\Repositories\SupplierRepositoryInterface;

class DeleteSupplierUseCase
{
    public function __construct(protected SupplierRepositoryInterface $repository) {}
    public function execute(int $id): void
    {
        $this->repository->findOrFail($id);
        $this->repository->delete($id);
    }
}
