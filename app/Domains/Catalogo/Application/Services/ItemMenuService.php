<?php

namespace App\Domains\Catalogo\Application\Services;

use App\Domains\Catalogo\Application\Exceptions\ItemMenu\ItemMenuNotFoundException;
use App\Domains\Catalogo\Domain\Repositories\ItemMenuRepositoryInterface;
use App\Models\ItemMenu;
use App\Models\User;
use Illuminate\Support\Collection;

class ItemMenuService
{
    protected ItemMenuRepositoryInterface $itemMenu;
    public function __construct(ItemMenuRepositoryInterface $itemMenu)
    {
        $this->itemMenu = $itemMenu;
    }

    public function findAll(User $user, ?int $restauranteId = null): Collection
    {
        return $this->itemMenu->findAll($user, $restauranteId);
    }

    public function find(int $id): ItemMenu
    {
        return $this->findOrFail($id);
    }
    public function create(array $data): ItemMenu
    {
        return $this->itemMenu->create($data);
    }

    public function update(array $data, int $id): ItemMenu
    {
        $itemMenu = $this->findOrFail($id);
        return $this->itemMenu->update($itemMenu, $data);
    }
    public function delete(int $id): void
    {
        $itemMenu = $this->findOrFail($id);
        $this->itemMenu->delete($itemMenu);
    }

    public function findOrFail(int $id): ItemMenu
    {
        $itemMenu = $this->itemMenu->find($id);
        if (!$itemMenu) {
            throw new ItemMenuNotFoundException;
        }
        return $itemMenu;
    }
}
