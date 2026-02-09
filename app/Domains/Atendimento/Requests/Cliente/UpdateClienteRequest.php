<?php

namespace App\Domains\Atendimento\Requests\Cliente;

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
        ];
    }

    public function messages()
    {
        return [
            'telefone.string' => 'O campo telefone deve ser do tipo texto',
            'endereco.string' => 'O endereço tem que ser do tipo texto',
        ];
    }
}
