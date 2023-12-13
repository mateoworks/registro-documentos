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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->uuid('empresa_id');
            $table->string('nombre');
            $table->string('asesor_externo')->nullable();
            $table->string('asesor_externo_puesto')->nullable();
            $table->string('nombre_firmara')->nullable();
            $table->string('nombre_firmara_puesto')->nullable();
            $table->timestamps();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
