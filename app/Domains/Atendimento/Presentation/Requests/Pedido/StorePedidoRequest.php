<?php

namespace App\Domains\Atendimento\Presentation\Requests\Pedido;

use App\Models\Pedido;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePedidoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $restauranteId = $this->route('restaurante')?->id;

        return [
            'status' => ['sometimes', Rule::in(Pedido::STATUS_PEDIDO)],
            'data_hora' => 'sometimes|date',
            'cliente_id' => 'sometimes|exists:clientes,id',
            'mesa_id' => 'nullable|exists:mesas,id',
            'atendente_id' => [
                'nullable',
                'integer',
                Rule::exists('restaurante_users', 'user_id')
                    ->where('restaurante_id', $restauranteId)
                    ->whereIn('role', ['FUNCIONARIO']),
            ],
            'itens' => 'required|array|min:1',
            'itens.*.item_menu_id' => 'required|exists:itens_menu,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.observacoes' => 'sometimes|nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'O status deve ser: aberto, preparando, finalizado ou pago.',
            'data_hora.date' => 'A data e hora informadas são inválidas.',
            'cliente_id.required' => 'O cliente é obrigatório.',
            'cliente_id.exists' => 'O cliente informado não existe.',
            'mesa_id.exists' => 'A mesa informada não existe.',
            'atendente_id.exists' => 'O atendente informado não existe.',
            'itens.required' => 'É necessário informar ao menos um item.',
            'itens.array' => 'Os itens do pedido são inválidos.',
            'itens.min' => 'É necessário informar ao menos um item.',
            'itens.*.item_menu_id.required' => 'O item do cardápio é obrigatório.',
            'itens.*.item_menu_id.exists' => 'O item do cardápio informado não existe.',
            'itens.*.quantidade.required' => 'A quantidade do item é obrigatória.',
            'itens.*.quantidade.integer' => 'A quantidade do item deve ser um número inteiro.',
            'itens.*.quantidade.min' => 'A quantidade do item deve ser no mínimo 1.',
        ];
    }
}
