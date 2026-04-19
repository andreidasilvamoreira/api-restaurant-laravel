<?php

namespace App\Domains\Identity\Presentation\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->route('user');
        $emailId = $user?->id;

        return [
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes','email', 'max:255', Rule::unique('users')->ignore($emailId)],
            'password' => 'sometimes|string|min:6|confirmed',
            'role' => 'sometimes|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.string' => 'A senha deve ser uma string.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'role.string' => 'A role deve ser uma string.',
            'role.max' => 'A role não pode ter mais de 255 caracteres.',
        ];
    }
}
