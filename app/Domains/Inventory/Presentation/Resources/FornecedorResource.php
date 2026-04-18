<?php

namespace App\Domains\Inventory\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FornecedorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'nome' => $this->resource->name,
            'telefone' => $this->resource->phone,
            'email' => $this->resource->email,
            'endereco' => $this->resource->address,
            'restaurante_id' => $this->resource->restaurantId,
        ];
    }
}
