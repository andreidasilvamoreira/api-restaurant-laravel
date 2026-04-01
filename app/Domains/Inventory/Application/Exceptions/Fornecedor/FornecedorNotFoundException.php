<?php

namespace App\Domains\Inventory\Application\Exceptions\Fornecedor;

class FornecedorNotFoundException extends FornecedorException
{
    protected $message = 'Fornecedor não encontrado';
    public function getStatus(): int
    {
        return 404;
    }

    public function getErrorCode(): string
    {
        return 'FORNECEDOR_NOT_FOUND';
    }
}
