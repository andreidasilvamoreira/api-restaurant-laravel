<?php

namespace App\Domains\Restaurante\Requests\Restaurante;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestauranteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ativo' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.max' => 'Máximo 255 caracteres',
            'nome.string' => 'É necessário que seja do tipo texto',
            'nome.required' => 'É necessário ter um nome',
            'descricao.string' => 'É necessário que seja do tipo texto',
            'ativo.boolean' => 'O valor deve ser um boolean',
        ];
    }
}
