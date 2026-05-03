<?php

namespace App\Domains\Catalogo\Application\UseCases\ItemMenu;

use App\Domains\Catalogo\Application\Exceptions\ItemMenu\ItemMenuNotFoundException;
use App\Domains\Catalogo\Domain\Repositories\ItemMenuRepositoryInterface;

class DeleteItemMenuUseCase
{
    public function __construct(
        protected ItemMenuRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        $itemMenu = $this->repository->find($id);

        if (!$itemMenu) {
            throw new ItemMenuNotFoundException();
        }

        $this->repository->delete($itemMenu);
    }
}
