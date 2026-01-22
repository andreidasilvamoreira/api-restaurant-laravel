<?php

namespace App\Domains\Catalogo\Exceptions\Categoria;

use Exception;

abstract class CategoriaException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return 'CATEGORIA_NOT_FOUND';
    }
}
