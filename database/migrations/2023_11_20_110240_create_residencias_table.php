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
        Schema::create('residencias', function (Blueprint $table) {
            $table->id();
            $table->uuid('estudiante_id')->unique();
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('periodo_id');
            $table->unsignedBigInteger('asesor_interno_id')->nullable();
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
            $table->foreign('asesor_interno_id')->references('id')->on('asesor_interno')->onDelete('set null');
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residencias');
    }
};
