<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurante_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('restaurante_id')->constrained('restaurantes')->onDelete('cascade');
            $table->string('role');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->unique(['user_id', 'restaurante_id']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('restaurante_users');
    }
};
