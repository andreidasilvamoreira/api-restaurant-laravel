<?php

namespace App\Domains\Atendimento\Exceptions\Pedido;

use Exception;

abstract class PedidoException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return "PEDIDO_NOT_FOUND";
    }
}
