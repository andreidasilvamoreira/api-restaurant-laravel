<?php

namespace App\Domains\Catalogo\Application\UseCases\Categoria;

use App\Domains\Catalogo\Application\Exceptions\Categoria\CategoriaNotFoundException;
use App\Domains\Catalogo\Application\Mappers\CategoriaMapper;
use App\Domains\Catalogo\Domain\Repositories\CategoriaRepositoryInterface;

class FindCategoriaUseCase
{
    public function __construct(
        protected CategoriaRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        $categoria = $this->repository->find($id);

        if (!$categoria) {
            throw new CategoriaNotFoundException();
        }

        return CategoriaMapper::toOutput($categoria);
    }
}
