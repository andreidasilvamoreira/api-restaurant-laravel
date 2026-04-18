<?php

namespace App\Domains\Inventory\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventarioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'nome' => $this->resource->name,
            'unidade_medida' => $this->resource->unit,
            'preco_custo' => $this->resource->costPrice,
            'quantidade_atual' => $this->resource->currentQuantity,
            'fornecedor_id' => $this->resource->supplierId,
            'restaurante_id' => $this->resource->restaurantId,
        ];
    }
}
