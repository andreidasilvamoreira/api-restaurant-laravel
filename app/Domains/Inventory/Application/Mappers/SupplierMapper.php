<?php

namespace App\Domains\Inventory\Application\Mappers;

use App\Domains\Inventory\Application\DTOs\Fornecedor\CreateSupplierInput;
use App\Domains\Inventory\Application\DTOs\Fornecedor\SupplierOutput;
use App\Domains\Inventory\Domain\Entities\Supplier;

class SupplierMapper
{
    public static function inputToEntity(CreateSupplierInput $input): Supplier
    {
        return new Supplier(
            id: null,
            name: $input->name,
            phone: $input->phone,
            email: $input->email,
            address: $input->address,
            restaurantId: $input->restaurantId,
        );
    }

    public static function entityToOutput(Supplier $supplier): SupplierOutput
    {
        return new SupplierOutput(
            id: $supplier->getId(),
            name: $supplier->getName(),
            phone: $supplier->getPhone(),
            email: $supplier->getEmail(),
            address: $supplier->getAddress(),
            restaurantId: $supplier->getRestaurantId(),
        );
    }
}
