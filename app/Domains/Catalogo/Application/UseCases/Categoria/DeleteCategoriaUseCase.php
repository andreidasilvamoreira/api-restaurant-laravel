<?php

namespace App\Domains\Catalogo\Application\UseCases\Categoria;

use App\Domains\Catalogo\Application\Exceptions\Categoria\CategoriaNotFoundException;
use App\Domains\Catalogo\Domain\Repositories\CategoriaRepositoryInterface;

class DeleteCategoriaUseCase
{
    public function __construct(
        protected CategoriaRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        $categoria = $this->repository->find($id);

        if (!$categoria) {
            throw new CategoriaNotFoundException();
        }

        $this->repository->delete($categoria);
    }
}
