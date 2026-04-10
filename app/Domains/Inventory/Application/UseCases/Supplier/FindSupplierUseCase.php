<?php

namespace App\Domains\Inventory\Application\UseCases\Supplier;

use App\Domains\Inventory\Application\DTOs\Fornecedor\SupplierOutput;
use App\Domains\Inventory\Application\Mappers\SupplierMapper;
use App\Domains\Inventory\Domain\Repositories\SupplierRepositoryInterface;

class FindSupplierUseCase
{
    public function __construct(protected SupplierRepositoryInterface $repository) {}
    public function execute(int $id): SupplierOutput
    {
        $supplier = $this->repository->findOrFail($id);

        return SupplierMapper::entityToOutput($supplier);
    }
}
