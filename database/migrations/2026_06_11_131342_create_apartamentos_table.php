<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('apartamentos', function (Blueprint $table) {
            $table->id();
            $table->string('referencia')->unique();
            $table->string('tipologia'); // T0, T1, T2, T3...
            $table->string('morada');
            $table->decimal('area', 8, 2);
            $table->decimal('preco', 12, 2);
            $table->string('fotografia')->nullable();
            $table->enum('estado', ['Disponível', 'Vendido'])->default('Disponível');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartamentos');
    }
};
