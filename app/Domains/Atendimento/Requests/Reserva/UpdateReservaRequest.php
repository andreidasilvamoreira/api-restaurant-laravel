<?php

namespace App\Domains\Atendimento\Requests\Reserva;

use App\Models\Reserva;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReservaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data_reserva' => 'sometimes|date|after_or_equal:now',
            'numero_pessoas' => 'sometimes|integer|min:1',
            'status' => ['sometimes', Rule::in(Reserva::STATUS_RESERVA)],
            'mesa_id' => 'sometimes|nullable|exists:mesas,id',
            'restaurante_id' => 'sometimes|exists:restaurantes,id',
            'cliente_id' => 'sometimes|exists:clientes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'data_reserva.date' => 'A data da reserva é inválida.',
            'data_reserva.after_or_equal' => 'A data da reserva não pode ser no passado.',
            'numero_pessoas.integer' => 'O número de pessoas deve ser um número inteiro.',
            'numero_pessoas.min' => 'O número de pessoas deve ser no mínimo 1.',
            'status.in' => 'O status deve ser: cancelado, confirmada, finalizada ou pendente.',
            'mesa_id.exists' => 'A mesa informada não existe.',
            'restaurante_id.exists' => 'O restaurante informado não existe.',
            'cliente_id.exists' => 'O cliente informado não existe.',
        ];
    }
}
