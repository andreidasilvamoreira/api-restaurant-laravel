<?php

namespace App\Domains\Catalogo\Application\UseCases\Categoria;

use App\Domains\Catalogo\Application\Mappers\CategoriaMapper;
use App\Domains\Catalogo\Domain\Repositories\CategoriaRepositoryInterface;
use App\Models\User;

class FindUserCategoriaUseCase
{
    public function __construct(
        protected CategoriaRepositoryInterface $repository
    ) {}

    public function execute(User $user, ?int $restauranteId = null): array
    {
        $categorias = $this->repository->findAll($user, $restauranteId);

        return array_map(
            fn ($categoria) => CategoriaMapper::toOutput($categoria),
            $categorias->all()
        );
    }
}
