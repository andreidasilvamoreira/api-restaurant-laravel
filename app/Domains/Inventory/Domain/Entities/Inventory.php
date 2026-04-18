<?php

namespace App\Domains\Inventory\Domain\Entities;

class Inventory
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $unit,
        private float $currentQuantity,
        private float $costPrice,
        private int $restaurantId,
        private int $supplierId,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
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

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    public function getCostPrice(): float
    {
        return $this->costPrice;
    }

    public function setCostPrice(float $costPrice): void
    {
        $this->costPrice = $costPrice;
    }

    public function getCurrentQuantity(): float
    {
        return $this->currentQuantity;
    }

    public function setCurrentQuantity(float $currentQuantity): void
    {
        $this->currentQuantity = $currentQuantity;
    }

    public function getRestaurantId(): int
    {
        return $this->restaurantId;
    }

    public function setRestauranteId(int $restaurantId): void
    {
        $this->restaurantId = $restaurantId;
    }

    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    public function setSupplierId(int $supplierId): void
    {
        $this->supplierId = $supplierId;
    }
}
