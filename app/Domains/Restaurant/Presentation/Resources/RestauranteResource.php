<?php

namespace App\Domains\Restaurant\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestauranteResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'nome' => $this->resource->name,
            'descricao' =>$this->resource->description,
            'ativo' => $this->resource->active
        ];
    }
}
