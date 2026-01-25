<?php

namespace App\Domains\Restaurante\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestauranteResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'endereco' =>$this->endereco,
            'ativo' => $this->ativo
        ];
    }
}
