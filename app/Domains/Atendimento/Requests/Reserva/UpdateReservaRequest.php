<?php

namespace App\Domains\Atendimento\Requests\Reserva;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

        ];
    }

    public function messages(): array
    {
        return [

        ];
    }
}
