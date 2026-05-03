<?php

namespace App\Domains\Atendimento\Application\UseCases\Pedido;

use App\Domains\Atendimento\Application\DTOs\Pedido\CreatePedidoInput;
use App\Domains\Atendimento\Application\Mappers\PedidoMapper;
use App\Domains\Atendimento\Domain\Repositories\PedidoRepositoryInterface;
use App\Models\ItemMenu;
use Illuminate\Support\Facades\DB;

class CreatePedidoUseCase
{
    public function __construct(
        protected PedidoRepositoryInterface $repository
    ) {}

    public function execute(CreatePedidoInput $input)
    {
        $pedido = DB::transaction(function () use ($input) {
            $pedido = $this->repository->create([
                'data_hora' => $input->dataHora,
                'status' => $input->status,
                'cliente_id' => $input->clienteId,
                'mesa_id' => $input->mesaId,
                'restaurante_id' => $input->restauranteId,
                'atendente_id' => $input->atendenteId,
            ]);

            if ($input->itens !== []) {
                $itemsMenu = ItemMenu::query()
                    ->whereIn('id', array_column($input->itens, 'item_menu_id'))
                    ->get()
                    ->keyBy('id');

                foreach ($input->itens as $item) {
                    $itemMenu = $itemsMenu->get($item['item_menu_id']);

                    if (!$itemMenu) {
                        continue;
                    }

                    $pedido->itensPedido()->create([
                        'item_menu_id' => $itemMenu->id,
                        'quantidade' => $item['quantidade'],
                        'preco_unitario' => $itemMenu->preco,
                        'observacoes' => $item['observacoes'] ?? null,
                    ]);
                }
            }

            return $pedido->fresh(['itensPedido.itemMenu']);
        });

        return PedidoMapper::toOutput($pedido);
    }
}
