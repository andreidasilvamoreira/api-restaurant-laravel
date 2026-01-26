<?php

namespace App\Domains\Atendimento\Requests\Mesa;

use Illuminate\Foundation\Http\FormRequest;

class StoreMesaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero' => 'required|integer|min:1',
            'capacidade' => 'required|integer|min:1',
            'status' => 'required|in:disponivel,ocupada,reservada',
            'restaurante_id' => 'required|exists:restaurantes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'numero.required' => 'O número da mesa é obrigatório.',
            'numero.integer' => 'O número da mesa deve ser um valor inteiro.',
            'numero.min' => 'O número da mesa deve ser maior que zero.',
            'capacidade.required' => 'A capacidade da mesa é obrigatória.',
            'capacidade.integer' => 'A capacidade deve ser um valor inteiro.',
            'capacidade.min' => 'A capacidade deve ser maior que zero.',
            'status.required' => 'O status da mesa é obrigatório.',
            'status.in' => 'O status deve ser: disponivel, ocupada ou reservada.',
            'restaurante_id.required' => 'O restaurante é obrigatório.',
            'restaurante_id.exists' => 'O restaurante informado não existe.',
        ];
    }
}
