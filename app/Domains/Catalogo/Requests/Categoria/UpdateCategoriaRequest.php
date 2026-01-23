<?php

namespace App\Domains\Catalogo\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'sometimes|string|max:100',
            'descricao' => 'nullable|string',
            'restaurante_id' => 'sometimes|exists:restaurantes,id',
        ];
    }
    public function messages(): array
    {
        return [
            'nome.string' => 'O nome da Categoria precisa ser do tipo texto.',
            'nome.max' => 'O nome da Categoria tem que ter no máximo 100 caracteres.',
            'descricao.string' => 'A descricao da categoria precisa ser do tipo texto.',
            'restaurante_id.exists' => 'O restaurante informado não existe.',
        ];
    }
}
