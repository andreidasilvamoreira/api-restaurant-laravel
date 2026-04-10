<?php

namespace App\Domains\Inventory\Infrastructure\Persistence\Mappers;

use App\Domains\Inventory\Domain\Entities\Inventory;
use App\Models\Inventario;

class InventoryModelMapper
{
    public static function modelToEntity(Inventario $model): Inventory
    {
        return new Inventory(
            id: $model->id,
            name: $model->nome,
            unit: $model->unidade_medida,
            currentQuantity: $model->quantidade_atual,
            costPrice: $model->preco_custo,
            restaurantId: $model->restaurante_id,
            supplierId: $model->fornecedor_id
        );
    }

    public static function entityToArray(Inventory $inventory): array
    {
        return [
            'id' => $inventory->getId(),
            'nome' => $inventory->getName(),
            'unidade_medida' => $inventory->getUnit(),
            'quantidade_atual' => $inventory->getCurrentQuantity(),
            'preco_custo' => $inventory->getCostPrice(),
            'restaurante_id' => $inventory->getRestauranteId(),
            'fornecedor_id' => $inventory->getFornecedorId(),
        ];
    }
}
