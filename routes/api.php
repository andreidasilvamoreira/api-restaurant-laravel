<?php

use App\Domains\Catalogo\Controllers\CategoriaController;
use App\Domains\Financeiro\Controllers\ClienteController;
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

