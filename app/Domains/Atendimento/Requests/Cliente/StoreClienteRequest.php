<?php

namespace App\Domains\Atendimento\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return !$this->user()->cliente()->exists();
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
            'telefone.string' => 'É necessário que o numero seja do tipo texto',
            'endereco.string' => 'O endereço tem que ser do tipo texto',
        ];
    }
}
