<?php

namespace App\Providers;

use App\Domains\Atendimento\Domain\Repositories\ClienteRepositoryInterface;
use App\Domains\Atendimento\Domain\Repositories\MesaRepositoryInterface;
use App\Domains\Atendimento\Domain\Repositories\PedidoRepositoryInterface;
use App\Domains\Atendimento\Domain\Repositories\ReservaRepositoryInterface;
use App\Domains\Atendimento\Infrastructure\Persistence\Eloquent\Repositories\ClienteRepository;
use App\Domains\Atendimento\Infrastructure\Persistence\Eloquent\Repositories\MesaRepository;
use App\Domains\Atendimento\Infrastructure\Persistence\Eloquent\Repositories\PedidoRepository;
use App\Domains\Atendimento\Infrastructure\Persistence\Eloquent\Repositories\ReservaRepository;
use App\Domains\Catalogo\Domain\Repositories\CategoriaRepositoryInterface;
use App\Domains\Catalogo\Domain\Repositories\ItemMenuRepositoryInterface;
use App\Domains\Catalogo\Infrastructure\Persistence\Eloquent\Repositories\CategoriaRepository;
use App\Domains\Catalogo\Infrastructure\Persistence\Eloquent\Repositories\ItemMenuRepository;
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

        $this->app->bind(
            CategoriaRepositoryInterface::class,
            CategoriaRepository::class
        );

        $this->app->bind(
            ItemMenuRepositoryInterface::class,
            ItemMenuRepository::class
        );

        $this->app->bind(
            ClienteRepositoryInterface::class,
            ClienteRepository::class
        );

        $this->app->bind(
            MesaRepositoryInterface::class,
            MesaRepository::class
        );

        $this->app->bind(
            PedidoRepositoryInterface::class,
            PedidoRepository::class
        );

        $this->app->bind(
            ReservaRepositoryInterface::class,
            ReservaRepository::class
        );
    }
    public function boot(): void
    {
        //
    }
}
