<?php

namespace App\Domains\Atendimento\Application\Exceptions\Pedido;

class PedidoNotFoundException extends PedidoException
{
    protected $message = "Pedido não encontrado";
    public function getStatus(): int
    {
        return 404;
    }

    public function getErrorCode(): string
    {
        return "PEDIDO_NOT_FOUND";
    }
}
