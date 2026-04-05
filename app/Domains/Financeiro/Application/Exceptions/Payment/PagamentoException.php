<?php

namespace App\Domains\Financeiro\Application\Exceptions\Payment;

use Exception;

class PagamentoException extends Exception
{
    public function getStatus(): int
    {
        return 422;
    }

    public function getErrorCode(): string
    {
        return "PAGAMENTO_NOT_FOUND";
    }
}
