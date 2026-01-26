<?php

namespace App\Domains\Atendimento\Exceptions\Reserva;

class ReservaNotFoundException extends ReservaException
{
    protected $message = "Reserva não encontrada";

    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return "RESERVA_NOT_FOUND";
    }
}
