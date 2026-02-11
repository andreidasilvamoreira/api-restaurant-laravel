<?php

namespace App\Domains\Financeiro\Repositories;

use App\Models\Pagamento;
use App\Models\User;
use Illuminate\Support\Collection;

class PagamentoRepository
{
    public function findAll(User $user): Collection
    {
        $query = Pagamento::query();

        if (!in_array($user->role, ['SUPER_ADMIN', 'OWNER'], true)) {
            $query->whereHas('pedido.restaurante.users', function ($q) use ($user) {
                $q->whereKey($user->id)
                    ->whereIn('restaurante_users.role', ['ADMIN', 'DONO']);
            });
        }
        return $query->with(['pedido.restaurante'])->get();
    }

    public function find($id) : Pagamento
    {
        return Pagamento::find($id);
    }

    public function create(array $data) : Pagamento
    {
        return Pagamento::create($data);
    }

    public function update(Pagamento $pagamento, array $data) : Pagamento
    {
        $pagamento->update($data);
        return  $pagamento;
    }

    public function delete(Pagamento $pagamento) : void
    {
        $pagamento->delete();
    }
}
