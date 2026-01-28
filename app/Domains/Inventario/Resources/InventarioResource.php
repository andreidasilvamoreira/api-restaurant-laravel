<?php

namespace App\Domains\Inventario\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventarioResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'unidade' => $this->unidade,
            'preco_custo' => $this->preco_custo,
            'quantidade_atual' => $this->quantidade_atual,
            'fornecedor_id' => $this->fornecedor_id,
            'restaurante_id' => $this->restaurante_id
        ];
    }
}
