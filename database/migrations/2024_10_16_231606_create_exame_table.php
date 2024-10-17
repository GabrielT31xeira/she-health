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
        Schema::create('exame', function (Blueprint $table) {
            $table->id();
            $table->string('cartao_sus');
            $table->string('endereco');
            $table->string('nome_exame');
            $table->string('nome_mae');
            $table->string('cid10_diagnostico')->nullable();
            $table->string('motivo_consulta');
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exame');
    }
};
