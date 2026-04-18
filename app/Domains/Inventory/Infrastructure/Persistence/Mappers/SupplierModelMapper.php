<?php

namespace App\Domains\Inventory\Infrastructure\Persistence\Mappers;

use App\Domains\Inventory\Domain\Entities\Supplier;
use App\Models\Fornecedor;

class SupplierModelMapper
{
    public static function modelToEntity(Fornecedor $model): Supplier
    {
        return new Supplier(
            id: $model->id,
            name: $model->nome,
            phone: $model->telefone,
            email: $model->email,
            address: $model->endereco,
            restaurantId: $model->restaurante_id,
        );
    }

    public static function entityToArray(Supplier $supplier): array
    {
        return [
            'nome' => $supplier->getName(),
            'telefone' => $supplier->getPhone(),
            'email' => $supplier->getEmail(),
            'endereco' => $supplier->getAddress(),
            'restaurante_id' => $supplier->getRestaurantId()
        ];
    }
}
