<?php

namespace App\Domains\Catalogo\Application\DTOs\ItemMenu;

class CreateItemMenuInput
{
    public function __construct(
        public readonly string $nome,
        public readonly ?string $descricao,
        public readonly float $preco,
        public readonly string $disponibilidade,
        public readonly int $categoriaId,
    ) {}
}
