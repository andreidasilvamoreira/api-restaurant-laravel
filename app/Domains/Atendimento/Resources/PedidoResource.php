<?php

namespace App\Domains\Atendimento\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PedidoResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'data_hora' => $this->data_hora,
            'status' => $this->status,
            'cliente_id' => $this->cliente,
            'mesa_id' => $this->mesa_id,
            'restaurante_id' => $this->restaurante_id,
            'atendente_id' => $this->atendente_id,
        ];
    }
}
