<?php

namespace App\Domains\Atendimento\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservaResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'data_reserva' => $this->data_reserva,
            'numero_pessoas' => $this->numero_pessoas,
            'status' => $this->status,
            'cliente_id' => $this->cliente_id,
            'mesa_id' => $this->mesa_id,
            'restaurante_id' => $this->restaurante_id,
        ];
    }
}
