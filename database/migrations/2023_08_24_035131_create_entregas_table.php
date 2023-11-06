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
        Schema::create('entregas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('estudiante_id');
            $table->unsignedBigInteger('documento_id');
            $table->string('url_documento')->nullable();
            $table->timestamp('fecha_entrega');
            $table->boolean('estado')->default(false);
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->foreign('documento_id')->references('id')->on('documentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
