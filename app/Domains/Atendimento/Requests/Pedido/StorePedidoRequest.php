<?php

namespace App\Domains\Atendimento\Requests\Pedido;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:aberto,preparando,finalizado,pago',
            'data_hora' => 'required|date',
            'restaurante_id' => 'required|exists:restaurantes,id',
            'cliente_id' => 'required|exists:clientes,id',
            'mesa_id' => 'nullable|exists:mesas,id',
            'atendente_id' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'O status do pedido é obrigatório.',
            'status.in' => 'O status deve ser: aberto, preparando, finalizado ou pago.',
            'data_hora.required' => 'A data e hora do pedido são obrigatórias.',
            'data_hora.date' => 'A data e hora informadas são inválidas.',
            'restaurante_id.required' => 'O restaurante é obrigatório.',
            'restaurante_id.exists' => 'O restaurante informado não existe.',
            'cliente_id.required' => 'O cliente é obrigatório.',
            'cliente_id.exists' => 'O cliente informado não existe.',
            'mesa_id.exists' => 'A mesa informada não existe.',
            'atendente_id.exists' => 'O atendente informado não existe.',
        ];
    }
}
