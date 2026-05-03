<?php

namespace App\Domains\Catalogo\Domain\Repositories;

use App\Models\ItemMenu;
use App\Models\User;
use Illuminate\Support\Collection;

interface ItemMenuRepositoryInterface
{
    public function findAll(User $user, ?int $restauranteId = null): Collection;
    public function find(int $id): ?ItemMenu;
    public function create(array $data): ItemMenu;
    public function update(ItemMenu $itemMenu, array $data): ItemMenu;
    public function delete(ItemMenu $itemMenu): void;
}
