<?php

namespace App\Domains\Atendimento\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MesaResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'numero' => $this->numero,
            'capacidade' => $this->capacidade,
            'status' => $this->status,
            'restaurante_id' => $this->restaurante_id,
        ];
    }
}
