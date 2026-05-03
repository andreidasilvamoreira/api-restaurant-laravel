<?php

namespace App\Domains\Atendimento\Application\Mappers;

use App\Domains\Atendimento\Application\DTOs\Reserva\ReservaOutput;
use App\Models\Reserva;

class ReservaMapper
{
    public static function toOutput(Reserva $reserva): ReservaOutput
    {
        return new ReservaOutput(
            id: $reserva->id,
            data_reserva: $reserva->data_reserva instanceof \DateTimeInterface
                ? $reserva->data_reserva->format('Y-m-d H:i:s')
                : (string) $reserva->data_reserva,
            numero_pessoas: $reserva->numero_pessoas,
            status: $reserva->status,
            cliente_id: $reserva->cliente_id,
            mesa_id: $reserva->mesa_id,
            restaurante_id: $reserva->restaurante_id,
        );
    }
}
