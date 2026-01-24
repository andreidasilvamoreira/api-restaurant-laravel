<?php

namespace App\Domains\Financeiro\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PagamentoResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'data_hora' => $this->data_hora,
            'valor' => $this->valor,
            'forma_pagamento' => $this->forma_pagamento,
            'status_pagamento' => $this->status_pagamento,
            'pedido_id' => $this->pedido_id
        ];
    }
}
