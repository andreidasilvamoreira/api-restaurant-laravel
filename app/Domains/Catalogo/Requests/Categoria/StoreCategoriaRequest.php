<?php

namespace App\Domains\Catalogo\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string',
            'restaurante_id' => 'required|exists:restaurantes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da Categoria precisa ser preenchido.',
            'nome.max' => 'O tamanho máximo é de 100 caracteres.',
            'nome.string' => 'O nome da Categoria precisa ser do tipo texto.',
            'descricao.string' => 'A descricao da categoria precisa ser do tipo texto.',
            'restaurante_id.exists' => 'o restaurante precisa existir.',
            'restaurante_id.required' => 'O restaurante precisa ser selecionado.',
        ];
    }
}
