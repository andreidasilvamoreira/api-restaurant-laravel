<?php

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
            $table->string('forma_pagamento');
            $table->enum('status_pagamento', ['pendente', 'confirmado']);
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
