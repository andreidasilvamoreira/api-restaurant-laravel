<?php

namespace App\Domains\Financeiro\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PagamentoResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'data_hora' => $this->resource->dataHora,
            'valor' => $this->resource->valor,
            'forma_pagamento' => $this->resource->formaPagamento,
            'status_pagamento' => $this->resource->statusPagamento,
            'pedido_id' => $this->resource->pedidoId,
        ];
    }
}
