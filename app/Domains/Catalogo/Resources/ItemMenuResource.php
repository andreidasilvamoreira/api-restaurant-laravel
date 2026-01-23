<?php

namespace App\Domains\Catalogo\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemMenuResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'disponibilidade' => $this->disponibilidade,
            'categoria_id' => $this->categoria_id
        ];
    }
}
