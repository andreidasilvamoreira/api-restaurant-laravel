<?php

namespace App\Domains\Inventario\Requests\Inventario;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'sometimes|required|string|max:150',
            'unidade' => 'sometimes|required|string|max:20',
            'preco_custo' => 'sometimes|required|numeric|min:0',
            'quantidade_atual' => 'sometimes|required|numeric|min:0',
            'fornecedor_id' => 'sometimes|required|exists:fornecedores,id',
            'restaurante_id' => 'sometimes|required|exists:restaurantes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'unidade.required' => 'A unidade é obrigatória.',
            'preco_custo.required' => 'O preço de custo é obrigatório.',
            'preco_custo.numeric' => 'O preço de custo deve ser um número.',
            'preco_custo.min' => 'O preço de custo não pode ser negativo.',
            'quantidade_atual.required' => 'A quantidade atual é obrigatória.',
            'quantidade_atual.numeric' => 'A quantidade atual deve ser um número.',
            'quantidade_atual.min' => 'A quantidade atual não pode ser negativa.',
            'fornecedor_id.required' => 'O fornecedor é obrigatório.',
            'fornecedor_id.exists' => 'Fornecedor inválido.',
            'restaurante_id.required' => 'O restaurante é obrigatório.',
            'restaurante_id.exists' => 'Restaurante inválido.',
        ];
    }
}
