<?php

namespace App\Domains\Atendimento\Exceptions\Reserva;

use Exception;

abstract class ReservaException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return "RESERVA_NOT_FOUND";
    }
}
