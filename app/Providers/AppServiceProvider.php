<?php

namespace App\Providers;

use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;
use App\Domains\Restaurant\Infrastructure\Persistence\Eloquent\Repositories\EloquentRestaurantRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            RestaurantRepositoryInterface::class,
            EloquentRestaurantRepository::class,
        );
    }
    public function boot(): void
    {
        //
    }
}
