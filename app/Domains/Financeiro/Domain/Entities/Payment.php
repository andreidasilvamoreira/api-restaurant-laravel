<?php

namespace App\Domains\Financeiro\Domain\Entities;

use App\Domains\Financeiro\Domain\Enums\PaymentOptions;
use App\Domains\Financeiro\Domain\Enums\PaymentStatus;
use DomainException;

class Payment
{
    public function __construct(
        private ?int $id,
        private \DateTimeImmutable $dataHora,
        private  string $valor,
        private PaymentOptions $formaPagamento,
        private PaymentStatus $statusPagamento,
        private int $pedidoId,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (trim($this->valor) === '') {
            throw new DomainException('O valor do pagamento não pode ser vazio.');
        }

        if ($this->pedidoId <= 0) {
            throw new DomainException('O pedido do pagamento é inválido.');
        }
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDataHora(): \DateTimeImmutable
    {
        return $this->dataHora;
    }

    public function setDataHora(\DateTimeImmutable $dataHora): void
    {
        $this->dataHora = $dataHora;
    }

    public function getValor(): string
    {
        return $this->valor;
    }

    public function setValor(string $valor): void
    {
        $this->valor = $valor;
    }

    public function getFormaPagamento(): PaymentOptions
    {
        return $this->formaPagamento;
    }

    public function setFormaPagamento(PaymentOptions $formaPagamento): void
    {
        $this->formaPagamento = $formaPagamento;
    }

    public function getStatusPagamento(): PaymentStatus
    {
        return $this->statusPagamento;
    }

    public function setStatusPagamento(PaymentStatus $statusPagamento): void
    {
        $this->statusPagamento = $statusPagamento;
    }

    public function getPedidoId(): int
    {
        return $this->pedidoId;
    }

    public function setPedidoId(int $pedidoId): void
    {
        $this->pedidoId = $pedidoId;
    }
}
