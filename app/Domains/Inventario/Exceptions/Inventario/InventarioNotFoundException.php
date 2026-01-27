<?php

namespace App\Domains\Inventario\Exceptions\Inventario;

class InventarioNotFoundException extends InventarioException
{
    protected $message = 'Inventario não encontrado.';

    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return 'INVENTARIO_NOT_FOUND';
    }
}
