<?php

namespace App\Domains\Financeiro\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domains\Financeiro\Domain\Entities\Payment;
use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;
use App\Domains\Financeiro\Infrastructure\Persistence\Mappers\PaymentMapper;
use App\Models\Pagamento as PagamentoModel;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentPaymentRepository implements PaymentRepositoryInterface
{
    public function findVisibleByUser(User $user): array
    {
        $query = PagamentoModel::query();

        if (!in_array($user->role, ['SUPER_ADMIN', 'OWNER'], true)) {
            $query->whereHas('pedido.restaurante.users', function ($q) use ($user) {
                $q->whereKey($user->id)
                    ->whereIn('restaurante_users.role', ['ADMIN', 'DONO']);
            });
        }
        return $query->with(['pedido.restaurante'])->get()->map(fn (PagamentoModel $model) => PaymentMapper::toEntity($model))->all();
    }

    public function findById(int $id) : ?Payment
    {
        $model = PagamentoModel::find($id);

        if (!$model) {
            return null;
        }

        return PaymentMapper::toEntity($model);
    }

    public function create(Payment $payment) : Payment
    {
        $model = PagamentoModel::query()->create(PaymentMapper::entityToArray($payment));
        return PaymentMapper::toEntity($model);
    }

    public function update(Payment $payment) : Payment
    {
        $model = PagamentoModel::query()->findOrFail($payment->getId());
        $model->update(
            PaymentMapper::entityToArray($payment)
        );
        return PaymentMapper::toEntity($model);
    }

    public function delete(int $id) : void
    {
        $model = PagamentoModel::query()->findOrFail($id);
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
