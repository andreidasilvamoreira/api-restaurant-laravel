<?php

namespace App\Domains\Financeiro\Exceptions\Pagamento;

class PagamentoNotFoundException extends PagamentoException
{
    protected $message = "Pagamento não encontrado";

    public function getStatus() : int
    {
        return 404;
    }

    public function getErrorCode() : string
    {
        return "PAGAMENTO_NOT_FOUND";
    }
}
