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
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout-security', [AuthController::class, 'logoutSecurity']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});
Route::middleware(['auth:sanctum'])->group(function () {

    /* Dominio de Atendimento */
    Route::get('clientes', [ClienteController::class, 'index']);
    Route::get('me/clientes', [ClienteController::class, 'me']);
    Route::post('clientes', [ClienteController::class, 'store']);
    Route::put('me/clientes', [ClienteController::class, 'update']);
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy']);

    Route::apiResource('mesas', MesaController::class)->except(['create']);
    Route::post('restaurantes/{restaurante}/mesas', [MesaController::class, 'store']);

    Route::apiResource('pedidos', PedidoController::class)->except(['create']);
    Route::post('restaurantes/{restaurante}/pedidos', [PedidoController::class, 'store']);

    Route::apiResource('reservas', ReservaController::class)->except(['create']);
    Route::post('restaurantes/{restaurante}/reservas', [ReservaController::class, 'store']);

    /* Dominio de Catálogo */
    Route::apiResource('itens_menu', ItemMenuController::class)->except('store')->parameters(['itens_menu' => 'itemMenu']);
    Route::post('restaurante/{restaurante}/itens_menu', [ItemMenuController::class, 'store']);

    Route::apiResource('categorias', CategoriaController::class)->except('store');
    Route::post('restaurantes/{restaurante}/categorias', [CategoriaController::class, 'store']);

    /* Dominio de Financeiro */
    Route::apiResource('pagamentos', PagamentoController::class)->except('store');
    Route::post('restaurantes/{restaurante}/pagamentos', [PagamentoController::class, 'store']);

    /* Dominio de Restaurante */
    Route::apiResource('restaurantes', RestauranteController::class);

    /* Dominio de Inventário */
    Route::apiResource('inventarios', InventarioController::class)->except('store');
    Route::post('restaurantes/{restaurante}/inventarios', [InventarioController::class, 'store']);

    Route::apiResource('fornecedores', FornecedorController::class)->except('store')->parameters(['fornecedores' => 'fornecedor']);
    Route::post('restaurantes/{restaurante}/fornecedores', [FornecedorController::class, 'store']);

    /* Dominio de Identity */
    Route::apiResource('users', UserController::class);
    Route::middleware('ativo')->group(function () {
        Route::apiResource('restaurantes.usuarios', RestauranteUsuarioController::class)->only(['index', 'store', 'destroy']);
        Route::patch('restaurantes/{restaurante}/usuarios/{usuario}/role', [RestauranteUsuarioController::class, 'updateRole'])->middleware('role:ADMIN');
    });
});




