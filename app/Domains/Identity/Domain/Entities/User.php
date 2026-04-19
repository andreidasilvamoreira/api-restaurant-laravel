<?php

namespace App\Domains\Identity\Domain\Entities;

use DomainException;

class User
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $email,
        private ?string $password,
        private string $role,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (trim($this->name) === '') {
            throw new DomainException('O nome do usuário não pode ser vazio.');
        }

        if (trim($this->email) === '') {
            throw new DomainException('O e-mail do usuário não pode ser vazio.');
        }

        if ($this->role === '') {
            throw new DomainException('A role do usuário não pode ser vazia.');
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->validate();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
        $this->validate();
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
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
}
