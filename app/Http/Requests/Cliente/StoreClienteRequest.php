<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telefone' => 'integer',
            'endereco' => 'string',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'telefone.integer' => 'É necessário que o numero seja inteiro',
            'endereco.string' => 'O endereço tem que ser do tipo texto',
            'user_id.exists' => 'O usuário precisa existir',
            'user_id.required' => 'È necessário ter um usuário'
        ];
    }
}
