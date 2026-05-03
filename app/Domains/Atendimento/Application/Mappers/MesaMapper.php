<?php

namespace App\Domains\Atendimento\Application\Mappers;

use App\Domains\Atendimento\Application\DTOs\Mesa\MesaOutput;
use App\Models\Mesa;

class MesaMapper
{
    public static function toOutput(Mesa $mesa): MesaOutput
    {
        return new MesaOutput(
            id: $mesa->id,
            numero: $mesa->numero,
            capacidade: $mesa->capacidade,
            status: $mesa->status,
            restaurante_id: $mesa->restaurante_id,
        );
    }
}
