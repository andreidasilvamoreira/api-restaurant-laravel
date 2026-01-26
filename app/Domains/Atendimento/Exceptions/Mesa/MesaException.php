<?php

namespace App\Domains\Atendimento\Exceptions\Mesa;

use Exception;

abstract class MesaException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return "MESA_NOT_FOUND";
    }
}
