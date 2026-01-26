<?php

namespace App\Domains\Atendimento\Exceptions\Mesa;

class MesaNotFoundException extends MesaException
{
    protected $message = "Mesa não encontrada";

    public function getStatus(): int
    {
        return 404;
    }
    public function getErrorCode(): string
    {
        return "MESA_NOT_FOUND";
    }
}
