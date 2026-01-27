<?php

namespace App\Domains\Inventario\Exceptions\Inventario;

use Exception;

class InventarioException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return 'INVENTARIO_NOT_FOUND';
    }
}
