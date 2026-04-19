<?php

namespace App\Providers;

use App\Domains\Financeiro\Domain\Repositories\PaymentRepositoryInterface;
use App\Domains\Financeiro\Infrastructure\Persistence\Eloquent\Repositories\EloquentPaymentRepository;
use App\Domains\Identity\Domain\Repositories\RestauranteUsuarioRepositoryInterface;
use App\Domains\Identity\Domain\Repositories\UserRepositoryInterface;
use App\Domains\Identity\Infrastructure\Persistence\Eloquent\Repositories\RestauranteUsuarioRepository;
use App\Domains\Identity\Infrastructure\Persistence\Eloquent\Repositories\UserRepository;
use App\Domains\Inventory\Domain\Repositories\InventoryRepositoryInterface;
use App\Domains\Inventory\Domain\Repositories\SupplierRepositoryInterface;
use App\Domains\Inventory\Infrastructure\Persistence\Eloquent\Repositories\FornecedorRepository;
use App\Domains\Inventory\Infrastructure\Persistence\Eloquent\Repositories\InventarioRepository;
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

        $this->app->bind(
            InventoryRepositoryInterface::class,
            InventarioRepository::class
        );

        $this->app->bind(
            SupplierRepositoryInterface::class,
            FornecedorRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            RestauranteUsuarioRepositoryInterface::class,
            RestauranteUsuarioRepository::class
        );
    }
    public function boot(): void
    {
        //
    }
}
