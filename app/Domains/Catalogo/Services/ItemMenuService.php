<?php

namespace App\Domains\Catalogo\Services;

use App\Domains\Catalogo\Exceptions\ItemMenu\ItemMenuNotFoundException;
use App\Domains\Catalogo\Repositories\ItemMenuRepository;
use App\Models\ItemMenu;
use Illuminate\Support\Collection;

class ItemMenuService
{
    protected ItemMenuRepository $itemMenu;
    public function __construct(ItemMenuRepository $itemMenu)
    {
        return $this->itemMenu = $itemMenu;
    }

    public function findAll(): Collection
    {
        return $this->itemMenu->findAll();
    }

    public function find($id): ?ItemMenu
    {
        return $this->findOrFail($id);
    }
    public function create(array $data): ItemMenu
    {
        return $this->itemMenu->create($data);
    }

    public function update(array $data, $id): ItemMenu
    {
        $itemMenu = $this->findOrFail($id);
        return $this->itemMenu->update($itemMenu,$data);
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
