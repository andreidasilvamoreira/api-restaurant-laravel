<?php

namespace App\Domains\Inventory\Application\UseCases\Inventory;

use App\Domains\Inventory\Application\DTOs\Inventario\InventoryOutput;
use App\Domains\Inventory\Application\DTOs\Inventario\UpdateInventoryInput;
use App\Domains\Inventory\Application\Mappers\InventoryMapper;
use App\Domains\Inventory\Domain\Repositories\InventoryRepositoryInterface;

class UpdateInventoryUseCase
{
    public function __construct( protected InventoryRepositoryInterface $repository ) {}

    public function execute(UpdateInventoryInput $data): InventoryOutput
    {
        $inventory = $this->repository->findOrFail($data->id);

        if ($data->name !== null) {
            $inventory->setName($data->name);
        }

        if ($data->unit !== null) {
            $inventory->setUnit($data->unit);
        }

        if ($data->currentQuantity !== null) {
            $inventory->setCurrentQuantity($data->currentQuantity);
        }

        if ($data->costPrice !== null) {
            $inventory->setCostPrice($data->costPrice);
        }

        if ($data->restaurantId !== null) {
            $inventory->setRestauranteId($data->restaurantId);
        }

        if ($data->supplierId !== null) {
            $inventory->setSupplierId($data->supplierId);
        }

        $inventory = $this->repository->update($inventory);
        return InventoryMapper::entityToOutput($inventory);
    }
}
