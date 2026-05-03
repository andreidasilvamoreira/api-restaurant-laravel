<?php

namespace App\Domains\Atendimento\Application\Mappers;

use App\Domains\Atendimento\Application\DTOs\Cliente\ClienteOutput;
use App\Models\Cliente;

class ClienteMapper
{
    public static function toOutput(Cliente $cliente): ClienteOutput
    {
        return new ClienteOutput(
            id: $cliente->id,
            telefone: $cliente->telefone,
            endereco: $cliente->endereco,
            user_id: $cliente->user_id,
        );
    }
}
