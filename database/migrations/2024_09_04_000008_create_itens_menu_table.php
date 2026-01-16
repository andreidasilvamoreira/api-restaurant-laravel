<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itens_menu', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->text('descricao');
            $table->decimal('preco', 10, 2);
            $table->enum('disponibilidade', ['disponivel', 'indisponivel']);
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('itens_menu');
    }
};
