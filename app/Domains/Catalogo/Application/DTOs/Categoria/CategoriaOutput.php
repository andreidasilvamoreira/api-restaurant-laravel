<?php

namespace App\Domains\Catalogo\Application\DTOs\Categoria;

class CategoriaOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $nome,
        public readonly ?string $descricao,
        public readonly int $restaurante_id,
    ) {}
}
