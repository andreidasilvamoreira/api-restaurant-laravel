<?php

namespace App\Domains\Atendimento\Requests\Pedido;

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
        $restauranteId = $this->route('restaurante');
        return [
            'status' => 'required', Rule::in(['aberto','preparando','finalizado','pago']),
            'data_hora' => 'required|date',
            'cliente_id' => 'required|exists:clientes,id',
            'mesa_id' => 'nullable|exists:mesas,id',
            'atendente_id' => [
                'nullable',
                'integer',
                Rule::exists('restaurante_user', 'user_id')
                    ->where('restaurante_id', $restauranteId)
                    ->whereIn('role', ['FUNCIONARIO']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'O status do pedido é obrigatório.',
            'status.in' => 'O status deve ser: aberto, preparando, finalizado ou pago.',
            'data_hora.required' => 'A data e hora do pedido são obrigatórias.',
            'data_hora.date' => 'A data e hora informadas são inválidas.',
            'cliente_id.required' => 'O cliente é obrigatório.',
            'cliente_id.exists' => 'O cliente informado não existe.',
            'mesa_id.exists' => 'A mesa informada não existe.',
            'atendente_id.exists' => 'O atendente informado não existe.',
        ];
    }
}
