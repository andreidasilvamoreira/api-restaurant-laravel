<?php

namespace App\Domains\Restaurant\Domain\Entities;

use DomainException;

class Restaurant
{
    public function __construct(
        private ?int $id,
        private string $name,
        private ?string $description,
        private bool $active,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (trim($this->name) === '') {
            throw new DomainException('Nome do restaurante não pode ser vazio.');
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
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
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
