<?php

namespace App\Domains\Inventory\Application\Exceptions\Inventario;

class InventarioNotFoundException extends InventarioException
{
    protected $message = 'Inventory não encontrado.';

    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return 'INVENTARIO_NOT_FOUND';
    }
}
