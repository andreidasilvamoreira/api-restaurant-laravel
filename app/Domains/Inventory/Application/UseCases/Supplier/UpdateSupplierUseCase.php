<?php

namespace App\Domains\Inventory\Application\UseCases\Supplier;

use App\Domains\Inventory\Application\DTOs\Fornecedor\SupplierOutput;
use App\Domains\Inventory\Application\DTOs\Fornecedor\UpdateSuppplierInput;
use App\Domains\Inventory\Application\Mappers\SupplierMapper;
use App\Domains\Inventory\Domain\Repositories\SupplierRepositoryInterface;

class UpdateSupplierUseCase
{
    public function __construct(protected SupplierRepositoryInterface $repository) {}
    public function execute(UpdateSuppplierInput $data): SupplierOutput
    {
        $supplier = $this->repository->findOrFail($data->id);

        if ($data->name !== null) {
            $supplier->setName($data->name);
        }

        if ($data->phone !== null) {
            $supplier->setPhone($data->phone);
        }

        if ($data->email !== null) {
            $supplier->setEmail($data->email);
        }

        if ($data->address !== null) {
            $supplier->setAddress($data->address);
        }

        if ($data->restaurantId !== null) {
            $supplier->setRestaurantId($data->restaurantId);
        }

        $supplier = $this->repository->update($supplier);

        return SupplierMapper::entityToOutput($supplier);
    }
}
