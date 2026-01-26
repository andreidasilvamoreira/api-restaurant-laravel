<?php

namespace App\Domains\Atendimento\Requests\Mesa;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMesaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero' => 'sometimes|integer|min:1',
            'capacidade' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:disponivel,ocupada,reservada',
            'restaurante_id' => 'sometimes|exists:restaurantes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'numero.integer' => 'O número da mesa deve ser um valor inteiro.',
            'numero.min' => 'O número da mesa deve ser maior que zero.',
            'capacidade.integer' => 'A capacidade deve ser um valor inteiro.',
            'capacidade.min' => 'A capacidade deve ser maior que zero.',
            'status.in' => 'O status deve ser: disponivel, ocupada ou reservada.',
            'restaurante_id.exists' => 'O restaurante informado não existe.',

        ];
    }
}
