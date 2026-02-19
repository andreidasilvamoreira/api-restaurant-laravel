<?php

namespace App\Domains\Catalogo\Requests\ItemMenu;

use App\Models\ItemMenu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemMenuRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'string|max:100',
            'descricao' => 'nullable|string',
            'preco' => 'numeric|min:0.01',
            'disponibilidade' => ['sometimes', Rule::in(ItemMenu::DISPONIBILIDADE)],
            'categoria_id' => 'exists:categorias,id',
        ];
    }
    public function messages(): array
    {
        return [
            'nome.max' => 'O tamanho máximo é de 100 caracteres.',
            'nome.string' => 'O nome do Item precisa ser do tipo texto.',
            'descricao.string' => 'A descricao da categoria precisa ser do tipo texto.',
            'preco.numeric' => 'O preço deve ser um valor numérico.',
            'preco.min' => 'O preço deve ser maior que zero.',
            'disponibilidade.in' => 'Disponibilidade inválida.',
            'categoria_id.exists' => 'A categoria informada não existe.',
        ];
    }
}
