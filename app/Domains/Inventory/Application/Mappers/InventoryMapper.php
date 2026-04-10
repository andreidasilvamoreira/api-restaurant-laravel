<?php

namespace App\Domains\Inventory\Application\Mappers;

use App\Domains\Inventory\Application\DTOs\Inventario\CreateInventoryInput;
use App\Domains\Inventory\Application\DTOs\Inventario\InventoryOutput;
use App\Domains\Inventory\Domain\Entities\Inventory;

class InventoryMapper
{
    public static function inputToEntity(CreateInventoryInput $input): Inventory
    {
        return new Inventory(
            id: null,
            name: $input->name,
            unit: $input->unit,
            currentQuantity: $input->currentQuantity,
            costPrice: $input->costPrice,
            restaurantId: $input->restaurantId,
            supplierId: $input->supplierId,
        );
    }

    public static function entityToOutput(Inventory $inventory): InventoryOutput
    {
        return new InventoryOutput(
            id: $inventory->getId(),
            name: $inventory->getName(),
            unit: $inventory->getUnit(),
            currentQuantity: $inventory->getCurrentQuantity(),
            costPrice: $inventory->getCostPrice(),
            restaurantId: $inventory->getRestaurantId(),
            supplierId: $inventory->getSupplierId(),
        );
    }
}
