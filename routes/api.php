<?php

use App\Domains\Atendimento\Controllers\ClienteController;
use App\Domains\Catalogo\Controllers\CategoriaController;
use App\Domains\Catalogo\Controllers\ItemMenuController;
use App\Domains\Financeiro\Controllers\PagamentoController;
use App\Domains\Restaurante\Controllers\RestauranteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* Dominio de Atendimento */

Route::apiResource('clientes', ClienteController::class);

/* Dominio de Catálogo */

Route::apiResource('itens_menu', ItemMenuController::class);
Route::apiResource('categorias', CategoriaController::class);

/* Dominio de Financeiro */

Route::apiResource('pagamentos', PagamentoController::class);

/* Dominio de autenticação */

Route::apiResource('restaurantes', RestauranteController::class);

