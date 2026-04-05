<?php

namespace App\Domains\Financeiro\Application\Exceptions\Payment;

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
