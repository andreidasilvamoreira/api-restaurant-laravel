<?php

namespace App\Domains\Restaurante\Controllers;

use App\Domains\Catalogo\Resources\CategoriaResource;
use App\Domains\Restaurante\Requests\Restaurante\StoreRestauranteRequest;
use App\Domains\Restaurante\Requests\Restaurante\UpdateRestauranteRequest;
use App\Domains\Restaurante\Resources\RestauranteResource;
use App\Domains\Restaurante\Services\RestauranteService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RestauranteController extends Controller
{
    protected RestauranteService $restauranteService;
    public function __construct(RestauranteService $restauranteService)
    {
        $this->restauranteService = $restauranteService;
    }

    public function index(): AnonymousResourceCollection
    {
        return RestauranteResource::collection($this->restauranteService->findAll());
    }

    public function show(int $id): RestauranteResource
    {
        $restaurante = $this->restauranteService->find($id);
        return new RestauranteResource($restaurante);
    }

    public function store(StoreRestauranteRequest $request): RestauranteResource
    {
        $restaurante = $this->restauranteService->create($request->validated());
        return new RestauranteResource($restaurante);
    }

    public function update(UpdateRestauranteRequest $request, $id) : RestauranteResource
    {
        $restaurante = $this->restauranteService->update($id, $request->validated());
        return new RestauranteResource($restaurante);
    }

    public function destroy(int $id) : JsonResponse
    {
        $this->restauranteService->delete($id);
        return response()->json(['message' => 'Restaurante excluido com sucesso!']);
    }
}
