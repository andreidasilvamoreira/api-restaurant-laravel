<?php

namespace App\Domains\Financeiro\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Financeiro\Domain\Entities\Payment;
use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;
use App\Domains\Financeiro\Infrastructure\Persistence\Mappers\PaymentModelMapper;
use App\Models\Pagamento as PaymentModel;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentPaymentRepository implements PaymentRepositoryInterface
{
    public function findVisibleByUser(User $user): array
    {
        $query = PaymentModel::query();

        if (!in_array($user->role, ['SUPER_ADMIN', 'OWNER'], true)) {
            $query->whereHas('pedido.restaurante.users', function ($q) use ($user) {
                $q->whereKey($user->id)
                    ->whereIn('restaurante_users.role', ['ADMIN', 'DONO']);
            });
        }
        return $query->with(['pedido.restaurante'])->get()->map(fn (PaymentModel $model) => PaymentModelMapper::modelToEntity($model))->all();
    }

    public function findById(int $id) : ?Payment
    {
        $model = PaymentModel::find($id);

        if (!$model) {
            return null;
        }

        return PaymentModelMapper::modelToEntity($model);
    }

    public function create(Payment $payment) : Payment
    {
        $model = PaymentModel::query()->create(PaymentModelMapper::entityToArray($payment));
        return PaymentModelMapper::ModelToEntity($model);
    }

    public function update(Payment $payment) : Payment
    {
        $model = PaymentModel::query()->findOrFail($payment->getId());
        $model->update(
            PaymentModelMapper::entityToArray($payment)
        );
        return PaymentModelMapper::modelToEntity($model);
    }

    public function delete(int $id) : void
    {
        $model = PaymentModel::query()->findOrFail($id);
        $model->delete();
    }

    public function findOrFail(int $id): Payment
    {
        $payment = $this->findById($id);

        if(!$payment) {
            throw new ModelNotFoundException('Pagamento não encontrado.');
        }

        return $payment;
    }
}
