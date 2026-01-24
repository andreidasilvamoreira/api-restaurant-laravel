<?php

use App\Domains\Atendimento\Controllers\ClienteController;
use App\Domains\Catalogo\Controllers\CategoriaController;
use App\Domains\Catalogo\Controllers\ItemMenuController;
use App\Domains\Financeiro\Controllers\PagamentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categorias', [CategoriaController::class, 'findAll']);
Route::get('/categorias/{id}', [CategoriaController::class, 'find']);
Route::post('/categorias', [CategoriaController::class, 'create']);
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriaController::class, 'delete']);

Route::get('/clientes', [ClienteController::class, 'findAll']);
Route::get('/clientes/{id}', [ClienteController::class, 'find']);
Route::post('/clientes', [ClienteController::class, 'create']);
Route::put('/clientes/{id}', [ClienteController::class, 'update']);
Route::delete('/clientes/{id}', [ClienteController::class, 'delete']);

Route::get('/itensMenu', [ItemMenuController::class, 'findAll']);
Route::get('/itensMenu/{id}', [ItemMenuController::class, 'find']);
Route::post('/itensMenu', [ItemMenuController::class, 'create']);
Route::put('/itensMenu/{id}', [ItemMenuController::class, 'update']);
Route::delete('/itensMenu/{id}', [ItemMenuController::class, 'delete']);

Route::get('/pagamentos', [PagamentoController::class, 'findAll']);
Route::get('/pagamentos/{id}', [PagamentoController::class, 'find']);
Route::post('/pagamentos', [PagamentoController::class, 'create']);
Route::put('/pagamentos/{id}', [PagamentoController::class, 'update']);
Route::delete('/pagamentos/{id}', [PagamentoController::class, 'delete']);

