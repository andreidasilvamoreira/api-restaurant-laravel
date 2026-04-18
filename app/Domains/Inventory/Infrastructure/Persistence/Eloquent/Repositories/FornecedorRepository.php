<?php

namespace App\Domains\Inventory\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Inventory\Domain\Entities\Supplier;
use App\Domains\Inventory\Domain\Repositories\SupplierRepositoryInterface;
use App\Domains\Inventory\Infrastructure\Persistence\Mappers\SupplierModelMapper;
use App\Models\Fornecedor as FornecedorModel;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FornecedorRepository implements SupplierRepositoryInterface
{
    public function findVisibleByUser(User $user): array
    {
        $query = FornecedorModel::query()->with('restaurante');

        if ($user->role !== 'SUPER_ADMIN' && $user->role !== 'OWNER') {
            $query->whereHas('restaurante', function ($q) use ($user) {
                $q->whereHas('users', function ($q2) use ($user) {
                    $q2->whereKey($user->id)->whereIn('restaurante_users.role', ['DONO', 'ADMIN']);
                });
            });
        }
        return $query->get()->map(fn (FornecedorModel $model) => SupplierModelMapper::modelToEntity($model))->all();
    }

    public function findById(int $id): ?Supplier
    {
        $model = FornecedorModel::find($id);
        if (!$model) {
            return null;
        }

        return SupplierModelMapper::modelToEntity($model);
    }

    public function create(Supplier $supplier): Supplier
    {
        $model = FornecedorModel::query()->create(SupplierModelMapper::entityToArray($supplier));
        return SupplierModelMapper::modelToEntity($model);
    }

    public function update(Supplier $supplier): Supplier
    {
        $model = FornecedorModel::query()->findOrFail($supplier->getId());
        $model->update(SupplierModelMapper::entityToArray($supplier));
        return SupplierModelMapper::modelToEntity($model->fresh());
    }

    public function delete(int $id): void
    {
        $model = FornecedorModel::query()->findOrFail($id);
        $model->delete();
    }

    public function findOrFail(int $id): Supplier
    {
        $supplier = $this->findById($id);
        if (!$supplier) {
            throw new ModelNotFoundException('Fornecedor não encontrado');
        }

        return $supplier;
    }
}
