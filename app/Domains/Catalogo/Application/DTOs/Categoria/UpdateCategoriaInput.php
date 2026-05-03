<?php

namespace App\Domains\Catalogo\Application\DTOs\Categoria;

class UpdateCategoriaInput
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $nome,
        public readonly ?string $descricao,
        public readonly bool $descricaoInformada,
    ) {}
}
