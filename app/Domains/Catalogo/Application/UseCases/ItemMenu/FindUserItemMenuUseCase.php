<?php

namespace App\Domains\Catalogo\Application\UseCases\ItemMenu;

use App\Domains\Catalogo\Application\Mappers\ItemMenuMapper;
use App\Domains\Catalogo\Domain\Repositories\ItemMenuRepositoryInterface;
use App\Models\User;

class FindUserItemMenuUseCase
{
    public function __construct(
        protected ItemMenuRepositoryInterface $repository
    ) {}

    public function execute(User $user, ?int $restauranteId = null): array
    {
        $itens = $this->repository->findAll($user, $restauranteId);

        return array_map(
            fn ($itemMenu) => ItemMenuMapper::toOutput($itemMenu),
            $itens->all()
        );
    }
}
