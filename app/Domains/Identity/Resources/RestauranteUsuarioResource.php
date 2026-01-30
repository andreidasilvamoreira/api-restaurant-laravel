<?php

namespace App\Domains\Identity\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestauranteUsuarioResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'usuario' => $this->name,
            'role' => $this->pivot->role,
        ];
    }
}
