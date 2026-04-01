<?php

namespace App\Domains\Restaurant\Application\Services;

use App\Domains\Restaurant\Application\DTOs\Restaurante\CreateRestauranteInput;
use App\Domains\Restaurant\Application\DTOs\Restaurante\UpdateRestauranteInput;
use App\Domains\Restaurant\Domain\Entities\Restaurant;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;
use App\Domains\Restaurant\Infrastructure\Persistence\Mappers\RestaurantMapper;
use App\Domains\Restaurant\Application\Exceptions\Restaurante\RestauranteNotFoundException;
use App\Models\User;

class RestauranteService
{
    public function __construct(
        protected RestaurantRepositoryInterface $repository
    ) { }

    public function findAll(User $user): array
    {
        return $this->repository->findVisibleByUser($user);
    }

    public function find(int $id): ?Restaurant
    {
        return $this->findOrFail($id);
    }

    public function create(CreateRestauranteInput $data): Restaurant
    {
        $restaurant = new Restaurant(
            id: null,
            name: $data->name,
            description: $data->description,
            active: $data->active
        );

        return $this->repository->create($restaurant);
    }

    public function update(int $id, UpdateRestauranteInput $data): Restaurant
    {
        $restaurant = $this->findOrFail($id);

        if ($data->name !== null) {
            $restaurant->setName($data->name);
        }

        if ($data->description !== null) {
            $restaurant->setDescription($data->description);
        }

        if ($data->active !== null) {
            $restaurant->setActive($data->active);
        }

        return $this->repository->update($restaurant);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function findOrFail(int $id): Restaurant
    {
        $restaurante = $this->repository->findById($id);
        if (!$restaurante) {
            throw new RestauranteNotFoundException();
        }

        return $restaurante;
    }
}
