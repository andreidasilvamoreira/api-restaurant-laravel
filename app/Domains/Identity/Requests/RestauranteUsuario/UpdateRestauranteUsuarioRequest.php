<?php

namespace App\Domains\Identity\Requests\RestauranteUsuario;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestauranteUsuarioRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => 'required|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'A role é obrigatória.',
            'role.string' => 'A role deve ser um texto válido.',
            'role.max' => 'A role deve ter no máximo 50 caracteres.',
        ];
    }
}
