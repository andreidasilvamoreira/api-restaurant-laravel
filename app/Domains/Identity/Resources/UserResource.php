<?php

namespace App\Domains\Identity\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'nome' => $this->name,
            'email' => $this->email,
            'senha' => $this->password
        ];
    }
}
