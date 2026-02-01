<?php

namespace App\Domains\Identity\Requests\RestauranteUsuario;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestauranteUsuarioRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'role' => 'required|string|max:50',
            'ativo' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.integer' => 'O usuário deve ser um número válido.',
            'user_id.exists' => 'Usuário não encontrado.',
            'role.required' => 'A role é obrigatória.',
            'role.string' => 'A role deve ser um texto válido.',
            'role.max' => 'A role deve ter no máximo 50 caracteres.',
            'ativo.boolean' => 'O usuário deve ser um booleano.',
            'ativo.required.' => 'O valor de ativo deve ser preenchido.'
        ];
    }
}
