<?php

namespace App\Domains\Identity\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestauranteUsuarioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->resource->userId,
            'usuario' => $this->resource->name,
            'role' => $this->resource->role,
            'ativo' => $this->resource->active,
        ];
    }
}
