<?php

use App\Domains\Restaurante\Exceptions\Restaurante\RestauranteException;

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
