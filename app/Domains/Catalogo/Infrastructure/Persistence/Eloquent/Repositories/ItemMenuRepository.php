<?php

namespace App\Domains\Catalogo\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Catalogo\Domain\Repositories\ItemMenuRepositoryInterface;
use App\Models\ItemMenu;
use App\Models\User;
use Illuminate\Support\Collection;

class ItemMenuRepository implements ItemMenuRepositoryInterface
{
    public function findAll(User $user, ?int $restauranteId = null): Collection
    {
        $query = ItemMenu::query();

        if ($restauranteId !== null) {
            $query->whereHas('categoria', function ($q) use ($restauranteId) {
                $q->where('restaurante_id', $restauranteId);
            });
        }

        return $query->get();
    }

    public function find(int $id): ?ItemMenu
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
