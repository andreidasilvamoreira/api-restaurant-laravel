<?php

namespace App\Domains\Catalogo\Repositories;

use App\Models\ItemMenu;
use App\Models\User;
use Illuminate\Support\Collection;

class ItemMenuRepository
{
    public function findAll(User $user): Collection
    {
        $query = ItemMenu::query();

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('categoria.restaurante.users', function ($q) use ($user) {
                $q->whereKey($user->id)
                    ->whereIn('restaurante_users.role', ['ADMIN', 'DONO', 'FUNCIONARIO']);
            });
        }
        return $query->get();
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
