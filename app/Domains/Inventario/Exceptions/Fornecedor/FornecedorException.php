<?php

namespace App\Domains\Inventario\Exceptions\Fornecedor;

use Exception;

class FornecedorException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return 'FORNECEDOR_NOT_FOUND';
    }
}
