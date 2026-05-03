<?php

namespace App\Domains\Catalogo\Application\DTOs\Categoria;

class CreateCategoriaInput
{
    public function __construct(
        public readonly string $nome,
        public readonly ?string $descricao,
        public readonly int $restauranteId,
    ) {}
}
