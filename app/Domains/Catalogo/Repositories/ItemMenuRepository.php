<?php

namespace App\Domains\Catalogo\Repositories;

use App\Models\ItemMenu;
use Illuminate\Support\Collection;

class ItemMenuRepository
{
    public function findAll(): Collection
    {
        return ItemMenu::all();
    }

    public function find($id): ItemMenu
    {
        return ItemMenu::find($id);
    }

    public function create(array $data): ItemMenu
    {
        return ItemMenu::create($data);
    }

    public function update(ItemMenu $itemMenu, array $data): ItemMenu
    {
        $itemMenu->update($data);
        return $itemMenu;
    }

    public function delete(ItemMenu $itemMenu): void
    {
        $itemMenu->delete();
    }
}
