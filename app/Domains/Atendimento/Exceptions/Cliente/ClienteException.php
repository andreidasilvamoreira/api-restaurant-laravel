<?php

namespace App\Domains\Atendimento\Exceptions\Cliente;

use Exception;

abstract class ClienteException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return "CLIENTE_NOT_FOUND";
    }
}
