<?php

namespace App\Exceptions\Categoria;

class CategoriaNotFoundException extends CategoriaException
{
    protected $message = "Categoria não encontrada";

    public function getStatus(): int
    {
        return 404;
    }

    public function getErrorCode(): string
    {
        return 'CATEGORIA_NOT_FOUND';
    }
}
