<?php

namespace App\Domains\Atendimento\Application\Mappers;

use App\Domains\Atendimento\Application\DTOs\Pedido\PedidoOutput;
use App\Models\Pedido;

class PedidoMapper
{
    public static function toOutput(Pedido $pedido): PedidoOutput
    {
        return new PedidoOutput(
            id: $pedido->id,
            data_hora: $pedido->data_hora instanceof \DateTimeInterface
                ? $pedido->data_hora->format('Y-m-d H:i:s')
                : (string) $pedido->data_hora,
            status: $pedido->status,
            cliente_id: $pedido->cliente_id,
            mesa_id: $pedido->mesa_id,
            restaurante_id: $pedido->restaurante_id,
            atendente_id: $pedido->atendente_id,
            itens: $pedido->itensPedido->map(fn ($item) => [
                'id' => $item->id,
                'item_menu_id' => $item->item_menu_id,
                'nome' => $item->itemMenu?->nome,
                'quantidade' => $item->quantidade,
                'preco_unitario' => (float) $item->preco_unitario,
                'observacoes' => $item->observacoes,
            ])->all(),
        );
    }
}
