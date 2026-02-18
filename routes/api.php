<?php

use App\Domains\Atendimento\Controllers\ClienteController;
use App\Domains\Atendimento\Controllers\MesaController;
use App\Domains\Atendimento\Controllers\PedidoController;
use App\Domains\Atendimento\Controllers\ReservaController;
use App\Domains\Catalogo\Controllers\CategoriaController;
use App\Domains\Catalogo\Controllers\ItemMenuController;
use App\Domains\Financeiro\Controllers\PagamentoController;
use App\Domains\Identity\Controllers\RestauranteUsuarioController;
use App\Domains\Identity\Controllers\UserController;
use App\Domains\Inventario\Controllers\FornecedorController;
use App\Domains\Inventario\Controllers\InventarioController;
use App\Domains\Restaurante\Controllers\RestauranteController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout-security', [AuthController::class, 'logoutSecurity']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('clientes', [ClienteController::class, 'index']);
    Route::get('me/clientes', [ClienteController::class, 'me']);
    Route::post('clientes', [ClienteController::class, 'store']);
    Route::put('me/clientes', [ClienteController::class, 'update']);
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy']);

    Route::apiResource('mesas', MesaController::class)->except(['store']);
    Route::apiResource('pedidos', PedidoController::class)->except(['store']);
    Route::apiResource('reservas', ReservaController::class)->except(['store']);
    Route::apiResource('itens_menu', ItemMenuController::class)->except(['store'])->parameters(['itens_menu' => 'itemMenu']);
    Route::apiResource('categorias', CategoriaController::class)->except(['store']);
    Route::apiResource('pagamentos', PagamentoController::class)->except(['store']);
    Route::apiResource('restaurantes', RestauranteController::class);
    Route::apiResource('inventarios', InventarioController::class)->except(['store']);
    Route::apiResource('fornecedores', FornecedorController::class)->except(['store'])->parameters(['fornecedores' => 'fornecedor']);
    Route::apiResource('users', UserController::class);

    Route::prefix('restaurantes/{restaurante}')->middleware('ativo')->group(function () {
        Route::post('pedidos', [PedidoController::class, 'store']);
        Route::post('inventarios', [InventarioController::class, 'store']);
        Route::post('fornecedores', [FornecedorController::class, 'store']);
        Route::post('pagamentos', [PagamentoController::class, 'store']);
        Route::post('categorias', [CategoriaController::class, 'store']);
        Route::post('itens_menu', [ItemMenuController::class, 'store']);
        Route::post('reservas', [ReservaController::class, 'store']);
        Route::post('mesas', [MesaController::class, 'store']);
        Route::apiResource('usuarios', RestauranteUsuarioController::class)->only(['index', 'store', 'destroy']);
        Route::patch('usuarios/{usuario}/role', [RestauranteUsuarioController::class, 'updateRole'])->middleware('role:ADMIN');
    });
});
