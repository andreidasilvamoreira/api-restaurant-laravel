<?php

namespace App\Domains\Catalogo\Requests\ItemMenu;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemMenuRequest extends FormRequest
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
            'preco' => 'required|numeric|min:0.01',
            'disponibilidade' => 'required|in:disponivel,indisponivel',
            'categoria_id' => 'required|exists:categorias,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do Item precisa ser preenchido.',
            'nome.max' => 'O tamanho máximo é de 100 caracteres.',
            'nome.string' => 'O nome do Item precisa ser do tipo texto.',
            'descricao.string' => 'A descricao da categoria precisa ser do tipo texto.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser um valor numérico.',
            'preco.min' => 'O preço deve ser maior que zero.',
            'disponibilidade.required' => 'A disponibilidade é obrigatória.',
            'disponibilidade.in' => 'Disponibilidade inválida.',
            'categoria_id.required' => 'A categoria é obrigatória.',
            'categoria_id.exists' => 'A categoria informada não existe.',
        ];
    }
}
