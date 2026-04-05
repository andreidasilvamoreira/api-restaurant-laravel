<?php

namespace App\Domains\Financeiro\Presentation\Controllers;

use App\Domains\Financeiro\Application\DTOs\Payment\CreatePaymentInput;
use App\Domains\Financeiro\Application\DTOs\Payment\UpdatePaymentInput;
use App\Domains\Financeiro\Application\UseCases\Payment\CreatePaymentUseCase;
use App\Domains\Financeiro\Application\UseCases\Payment\DeletePaymentUseCase;
use App\Domains\Financeiro\Application\UseCases\Payment\FindPaymentUseCase;
use App\Domains\Financeiro\Application\UseCases\Payment\FindUserPaymentUseCase;
use App\Domains\Financeiro\Application\UseCases\Payment\UpdatePaymentUseCase;
use App\Domains\Financeiro\Domain\Enums\PaymentOptions;
use App\Domains\Financeiro\Domain\Enums\PaymentStatus;
use App\Domains\Financeiro\Presentation\Requests\Pagamento\StorePagamentoRequest;
use App\Domains\Financeiro\Presentation\Requests\Pagamento\UpdatePagamentoRequest;
use App\Domains\Financeiro\Presentation\Resources\PagamentoResource;
use App\Http\Controllers\Controller;
use App\Models\Pagamento;
use App\Models\Pedido;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PagamentoController extends Controller
{
    public function __construct(
        protected FindUserPaymentUseCase $findUserPaymentUseCase,
        protected FindPaymentUseCase $findPaymentUseCase,
        protected CreatePaymentUseCase $createPaymentUseCase,
        protected UpdatePaymentUseCase $updatePaymentUseCase,
        protected DeletePaymentUseCase $deletePaymentUseCase,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $output = $this->findUserPaymentUseCase->execute(auth()->user());

        return PagamentoResource::collection($output);
    }

    public function show(Pagamento $pagamento): PagamentoResource
    {
        $this->authorize('view', $pagamento);

        $output = $this->findPaymentUseCase->execute($pagamento->id);

        return new PagamentoResource($output);
    }

    public function store(StorePagamentoRequest $request, Pedido $pedido) : PagamentoResource
    {
        $restaurante = $pedido->restaurante;

        $this->authorize('createForRestaurant', [Pagamento::class, $restaurante]);
        $data = $request->validated();
        $input = new CreatePaymentInput(
            dataHora: $data['data_hora'],
            valor: $data['valor'],
            formaPagamento: PaymentOptions::from($data['forma_pagamento']),
            statusPagamento: PaymentStatus::from($data['status_pagamento']),
            pedidoId: $pedido->id,
        );

        $output = $this->createPaymentUseCase->execute($input);

        return new PagamentoResource($output);
    }

    public function update(UpdatePagamentoRequest $request, Pagamento $pagamento): PagamentoResource
    {
        $pedido = $pagamento->pedido;

        $this->authorize('update', $pagamento);

        $data = $request->validated();

        $input = new UpdatePaymentInput(
            id: $pagamento->id,
            dataHora: $data['data_hora'],
            valor: $data['valor'],
            formaPagamento: $data['forma_pagamento'],
            statusPagamento: $data['status_pagamento'],
            pedidoId: $pedido->id,
        );

        $output = $this->updatePaymentUseCase->execute($input);
        return new PagamentoResource($output);
    }

    public function destroy(Pagamento $pagamento): JsonResponse
    {
        $this->authorize('delete', $pagamento);

        $this->deletePaymentUseCase->execute($pagamento->id);

        return response()->json(['message' => "Pagamento deletado com sucesso!"], 200);
    }
}
