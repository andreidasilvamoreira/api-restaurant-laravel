<?php

namespace App\Domains\Restaurante\Application\Exceptions\Restaurante;

class RestauranteNotFoundException extends RestauranteException
{
    protected $message = "Restaurante não encontrado";

    public function getStatus(): int
    {
        return 404;
    }

    public function getErrorCode(): string
    {
        return "RESTAURANTE_NOT_FOUND";
    }
}
