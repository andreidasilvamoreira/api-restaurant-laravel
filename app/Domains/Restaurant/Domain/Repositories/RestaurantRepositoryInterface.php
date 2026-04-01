<?php

namespace App\Domains\Restaurant\Domain\Repositories;

use App\Domains\Restaurant\Domain\Entities\Restaurant;
use App\Models\User;

interface RestaurantRepositoryInterface {
    public function findVisibleByUser(User $user): array;
    public function findById(int $id) : ?Restaurant;
    public function create(Restaurant $restaurant): Restaurant;
    public function update(Restaurant $restaurant): Restaurant;
    public function delete(int $id): void;
}
