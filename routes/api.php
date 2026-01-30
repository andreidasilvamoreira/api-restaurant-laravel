<?php

use App\Domains\Atendimento\Controllers\ClienteController;
use App\Domains\Atendimento\Controllers\MesaController;
use App\Domains\Atendimento\Controllers\PedidoController;
use App\Domains\Atendimento\Controllers\ReservaController;
use App\Domains\Catalogo\Controllers\CategoriaController;
use App\Domains\Catalogo\Controllers\ItemMenuController;
use App\Domains\Financeiro\Controllers\PagamentoController;
use App\Domains\Identity\Controllers\RestauranteUsuarioController;
use App\Domains\Inventario\Controllers\FornecedorController;
use App\Domains\Inventario\Controllers\InventarioController;
use App\Domains\Restaurante\Controllers\RestauranteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* Dominio de Atendimento */

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('mesas', MesaController::class);
Route::apiResource('pedidos', PedidoController::class);
Route::apiResource('reservas', ReservaController::class);

/* Dominio de Catálogo */

Route::apiResource('itens_menu', ItemMenuController::class);
Route::apiResource('categorias', CategoriaController::class);

/* Dominio de Financeiro */

Route::apiResource('pagamentos', PagamentoController::class);

/* Dominio de autenticação */

Route::apiResource('restaurantes', RestauranteController::class);

/* Dominio de Inventário */

Route::apiResource('inventarios', InventarioController::class);
Route::apiResource('fornecedores', FornecedorController::class);

/* Dominio de Identity */

Route::apiResource('restaurantes.usuarios', RestauranteUsuarioController::class)->only(['index', 'store', 'destroy']);
Route::patch('restaurantes/{restaurante}/usuarios/{usuario}/role', [RestauranteUsuarioController::class, 'updateRole']);
