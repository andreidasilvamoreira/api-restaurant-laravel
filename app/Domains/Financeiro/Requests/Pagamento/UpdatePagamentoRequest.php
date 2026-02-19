<?php

namespace App\Domains\Financeiro\Requests\Pagamento;

use App\Models\Pagamento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePagamentoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data_hora' => 'date',
            'valor' => 'numeric|min:0.01',
            'forma_pagamento' =>  Rule::in(Pagamento::PAGAMENTO),
            'status_pagamento' => Rule::in(Pagamento::STATUS_PAGAMENTO),
            'pedido_id' => 'exists:pedidos,id',
        ];
    }

    public function messages() : array
    {
        return [
            'data_hora.date' => "A data precisa ser do tipo Date",
            'valor.min' => "O valor precisa ser maior que 0",
            'valor.numeric' => "O valor precisa ser do tipo Numeric",
            'forma_pagamento.in' => "O pagamento precisa ser pix, cartão de credito, cartão de débito ou dinheiro",
            'status_pagamento.in' => "O status do pagamento precisa ser selecionado",
            'pedido_id.exists' => "O pedido precisa existir"
        ];
    }
}
