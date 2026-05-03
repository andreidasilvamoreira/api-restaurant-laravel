<?php

namespace App\Domains\Catalogo\Application\Mappers;

use App\Domains\Catalogo\Application\DTOs\Categoria\CategoriaOutput;
use App\Models\Categoria;

class CategoriaMapper
{
    public static function toOutput(Categoria $categoria): CategoriaOutput
    {
        return new CategoriaOutput(
            id: $categoria->id,
            nome: $categoria->nome,
            descricao: $categoria->descricao,
            restaurante_id: $categoria->restaurante_id,
        );
    }
}
