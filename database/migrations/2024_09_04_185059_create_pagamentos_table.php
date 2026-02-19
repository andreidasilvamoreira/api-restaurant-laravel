<?php

use App\Models\Pagamento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data_hora');
            $table->decimal('valor');
            $table->string('forma_pagamento')->default(Pagamento::PAGAMENTO_PIX);
            $table->string('status_pagamento')->default(Pagamento::STATUS_PAGAMENTO_PENDENTE);
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
