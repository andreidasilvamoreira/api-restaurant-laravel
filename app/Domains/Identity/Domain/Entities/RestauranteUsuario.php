<?php

namespace App\Domains\Identity\Domain\Entities;

use DomainException;

class RestauranteUsuario
{
    public function __construct(
        private ?int $id,
        private int $restauranteId,
        private int $userId,
        private string $name,
        private string $role,
        private bool $active,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->restauranteId <= 0) {
            throw new DomainException('O restaurante informado é inválido.');
        }

        if ($this->userId <= 0) {
            throw new DomainException('O usuário informado é inválido.');
        }

        if (trim($this->role) === '') {
            throw new DomainException('A role do vínculo não pode ser vazia.');
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRestauranteId(): int
    {
        return $this->restauranteId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
        $this->validate();
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}
