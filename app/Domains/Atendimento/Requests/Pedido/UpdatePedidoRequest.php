<?php

namespace App\Domains\Atendimento\Requests\Pedido;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'sometimes|in:aberto,preparando,finalizado,pago',
            'data_hora' => 'sometimes|date',
            'restaurante_id' => 'sometimes|exists:restaurantes,id',
            'cliente_id' => 'sometimes|exists:clientes,id',
            'mesa_id' => 'nullable|exists:mesas,id',
            'atendente_id' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'O status deve ser: aberto, preparando, finalizado ou pago.',
            'data_hora.date' => 'A data e hora informadas são inválidas.',
            'restaurante_id.exists' => 'O restaurante informado não existe.',
            'cliente_id.exists' => 'O cliente informado não existe.',
            'mesa_id.exists' => 'A mesa informada não existe.',
            'atendente_id.exists' => 'O atendente informado não existe.',
        ];
    }
}
