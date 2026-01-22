<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telefone' => 'string',
            'endereco' => 'string',
            'user_id' => 'integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'telefone.string' => 'O campo telefone deve ser do tipo texto',
            'endereco.string' => 'O endereço tem que ser do tipo texto',
            'user_id.exists' => 'O usuário precisa existir',
            'user_id.integer' => 'O id precisa ser do tipo inteiro'
        ];
    }
}
