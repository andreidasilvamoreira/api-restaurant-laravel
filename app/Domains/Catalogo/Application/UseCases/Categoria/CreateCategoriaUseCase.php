<?php

namespace App\Domains\Catalogo\Application\UseCases\Categoria;

use App\Domains\Catalogo\Application\DTOs\Categoria\CreateCategoriaInput;
use App\Domains\Catalogo\Application\Mappers\CategoriaMapper;
use App\Domains\Catalogo\Domain\Repositories\CategoriaRepositoryInterface;

class CreateCategoriaUseCase
{
    public function __construct(
        protected CategoriaRepositoryInterface $repository
    ) {}

    public function execute(CreateCategoriaInput $input)
    {
        $categoria = $this->repository->create([
            'nome' => $input->nome,
            'descricao' => $input->descricao,
            'restaurante_id' => $input->restauranteId,
        ]);

        return CategoriaMapper::toOutput($categoria);
    }
}
