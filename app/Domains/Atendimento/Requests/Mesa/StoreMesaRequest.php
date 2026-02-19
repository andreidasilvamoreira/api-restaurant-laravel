<?php

namespace App\Domains\Atendimento\Requests\Mesa;

use App\Models\Mesa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'status' => ['sometimes', Rule::in(Mesa::STATUS)],
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
        ];
    }
}
