<?php

namespace App\Domains\Atendimento\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'telefone' => $this->telefone,
            'endereco'  => $this->endereco,
            'user_id' => $this->user_id
        ];
    }
}
