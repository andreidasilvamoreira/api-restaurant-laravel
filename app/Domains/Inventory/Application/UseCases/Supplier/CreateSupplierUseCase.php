<?php

namespace App\Domains\Inventory\Application\UseCases\Supplier;

use App\Domains\Inventory\Application\DTOs\Fornecedor\CreateSupplierInput;
use App\Domains\Inventory\Application\DTOs\Fornecedor\SupplierOutput;
use App\Domains\Inventory\Application\Mappers\SupplierMapper;
use App\Domains\Inventory\Domain\Repositories\SupplierRepositoryInterface;

class CreateSupplierUseCase
{
    public function __construct(protected SupplierRepositoryInterface $repository) {}
    public function execute(CreateSupplierInput $input): SupplierOutput
    {
        $supplier = SupplierMapper::inputToEntity($input);
        $supplier = $this->repository->create($supplier);

        return SupplierMapper::entityToOutput($supplier);
    }
}
