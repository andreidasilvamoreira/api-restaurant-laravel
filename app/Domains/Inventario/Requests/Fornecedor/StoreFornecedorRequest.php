<?php

namespace App\Domains\Inventario\Requests\Fornecedor;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:150',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'endereco' => 'required|string|max:255',
            'restaurante_id' => 'required|exists:restaurantes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.string' => 'O campo precisa ser do tipo texto',
            'restaurante_id.required' => 'O restaurante é obrigatório.',
            'restaurante_id.exists' => 'Restaurante inválido.',
        ];
    }
}
