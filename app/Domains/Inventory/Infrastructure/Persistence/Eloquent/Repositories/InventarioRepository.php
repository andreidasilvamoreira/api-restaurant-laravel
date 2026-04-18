<?php

namespace App\Domains\Inventory\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Inventory\Domain\Entities\Inventory;
use App\Domains\Inventory\Domain\Repositories\InventoryRepositoryInterface;
use App\Domains\Inventory\Infrastructure\Persistence\Mappers\InventoryModelMapper;
use App\Models\Inventario as InventarioModel;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InventarioRepository implements InventoryRepositoryInterface
{
    public function findVisibleByUser(User $user): array
    {
        $query = InventarioModel::query()->with('restaurante');

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('restaurante', function ($q) use ($user) {
                $q->whereHas('users', function ($q2) use ($user) {
                    $q2->whereKey($user->id)->whereIn('restaurante_users.role', ['DONO', 'FUNCIONARIO', 'ADMIN']);
                });
            });
        }

        return $query->get()->map(fn (InventarioModel $model) => InventoryModelMapper::modelToEntity($model))->all();
    }

    public function findById(int $id): ?Inventory
    {
        $model = InventarioModel::query()->find($id);

        if (!$model) {
            return null;
        }

        return InventoryModelMapper::modelToEntity($model);
    }

    public function create(Inventory $inventory): Inventory
    {
        $model = InventarioModel::query()->create(InventoryModelMapper::entityToArray($inventory));
        return InventoryModelMapper::modelToEntity($model);
    }

    public function update(Inventory $inventory): Inventory
    {
        $model = InventarioModel::query()->findOrFail($inventory->getId());
        $model->update(InventoryModelMapper::entityToArray($inventory));
        return InventoryModelMapper::modelToEntity($model->fresh());
    }

    public function delete(int $id): void
    {
        $model = InventarioModel::query()->findOrFail($id);
        $model->delete();
    }

    public function findOrFail(int $id): Inventory
    {
        $inventory = $this->findById($id);

        if (!$inventory) {
            throw new ModelNotFoundException('Inventario não encontrado');
        }

        return $inventory;
    }
}
