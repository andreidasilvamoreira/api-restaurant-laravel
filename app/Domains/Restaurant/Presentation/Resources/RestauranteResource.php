<?php

namespace App\Domains\Restaurant\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestauranteResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getId(),
            'nome' => $this->resource->getName(),
            'descricao' =>$this->resource->getDescription(),
            'ativo' => $this->resource->isActive(),
        ];
    }
}
