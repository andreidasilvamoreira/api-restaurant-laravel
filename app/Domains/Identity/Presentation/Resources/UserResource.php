<?php

namespace App\Domains\Identity\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'nome' => $this->resource->name,
            'email' => $this->resource->email,
            'role' => $this->resource->role,
        ];
    }
}
