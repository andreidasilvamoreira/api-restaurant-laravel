<?php

namespace App\Domains\Atendimento\Requests\Reserva;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data_reserva' => 'required|date|after_or_equal:now',
            'numero_pessoas' => 'required|integer|min:1',
            'status' => 'required|in:cancelado,confirmada,finalizada,pendente',
            'mesa_id' => 'nullable|exists:mesas,id',
            'restaurante_id' => 'required|exists:restaurantes,id',
            'cliente_id' => 'required|exists:clientes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'data_reserva.required' => 'A data da reserva é obrigatória.',
            'data_reserva.date' => 'A data da reserva é inválida.',
            'data_reserva.after_or_equal' => 'A data da reserva não pode ser no passado.',
            'numero_pessoas.required' => 'O número de pessoas é obrigatório.',
            'numero_pessoas.integer' => 'O número de pessoas deve ser um número inteiro.',
            'numero_pessoas.min' => 'O número de pessoas deve ser no mínimo 1.',
            'status.required' => 'O status da reserva é obrigatório.',
            'status.in' => 'O status deve ser: cancelado, confirmada, finalizada ou pendente.',
            'mesa_id.exists' => 'A mesa informada não existe.',
            'restaurante_id.required' => 'O restaurante é obrigatório.',
            'restaurante_id.exists' => 'O restaurante informado não existe.',
            'cliente_id.required' => 'O cliente é obrigatório.',
            'cliente_id.exists' => 'O cliente informado não existe.',
        ];
    }
}
