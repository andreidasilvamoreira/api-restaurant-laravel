<?php

namespace App\Domains\Financeiro\Requests\Pagamento;

use App\Models\Pagamento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePagamentoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data_hora' => 'required|date',
            'valor' => 'required|numeric|min:0.01',
            'forma_pagamento' => ['required', Rule::in(Pagamento::PAGAMENTO)],
            'status_pagamento' => ['required', Rule::in(Pagamento::STATUS_PAGAMENTO)],
            'pedido_id' => 'required|exists:pedidos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'data_hora.date' => "A data precisa ser do tipo Date",
            'data_hora.required' => "A data é necessária",
            'valor.min' => "O valor precisa ser maior que 0",
            'valor.numeric' => "O valor precisa ser do tipo Numeric",
            'valor.required' => "É necessário que tenha um valor",
            'forma_pagamento.in' => "O pagamento precisa ser pix, cartão de credito, cartão de débito ou dinheiro",
            'forma_pagamento.required' => "O pagamento precisa ser selecionado",
            'status_pagamento.required' => "O status do pagamento precisa existir",
            'status_pagamento.in' => "O status do pagamento precisa ser selecionado",
            'pedido_id.required' => "É necessário que exista um pedido",
            'pedido_id.exists' => "O pedido precisa existir"
        ];
    }
}
