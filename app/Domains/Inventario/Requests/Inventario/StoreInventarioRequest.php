<?php

namespace App\Domains\Inventario\Requests\Inventario;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:150',
            'unidade' => 'required|string|max:20',
            'preco_custo' => 'required|numeric|min:0',
            'quantidade_atual' => 'required|numeric|min:0',
            'fornecedor_id' => 'required|exists:fornecedores,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'unidade.required' => 'A unidade é obrigatória.',
            'preco_custo.required' => 'O preço de custo é obrigatório.',
            'quantidade_atual.required' => 'A quantidade atual é obrigatória.',
            'fornecedor_id.required' => 'O fornecedor é obrigatório.',
            'nome.string' => 'O campo nome deve ser texto.',
            'fornecedor_id.exists' => 'Fornecedor inválido.',
        ];
    }
}
