<?php

namespace App\Providers;

use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;
use App\Domains\Financeiro\Infrastructure\Persistence\Eloquent\Repositories\EloquentPaymentRepository;
use App\Domains\Restaurant\Domain\Repositories\RestaurantRepositoryInterface;
use App\Domains\Restaurant\Infrastructure\Persistence\Eloquent\Repositories\EloquentRestaurantRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            RestaurantRepositoryInterface::class,
            EloquentRestaurantRepository::class
        );

        $this->app->bind(
            PaymentRepositoryInterface::class,
            EloquentPaymentRepository::class
        );
    }
    public function boot(): void
    {
        //
    }
}
