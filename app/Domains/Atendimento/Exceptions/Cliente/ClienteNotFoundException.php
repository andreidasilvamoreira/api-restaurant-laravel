<?php

namespace App\Domains\Atendimento\Exceptions\Cliente;

class ClienteNotFoundException extends ClienteException
{
    protected $message = "Cliente não encotrado";

    public function getStatusCode() : int
    {
        return 404;
    }

    public function getErrorCode(): string
    {
        return "CLIENTES_NOT_FOUND";
    }
}
