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
        Schema::create('asignaciones_arbitrales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_arbitral_id')->constrained('grupos_arbitrales')->onDelete('cascade');
            $table->foreignId('arbitro_id')->constrained('arbitros')->onDelete('cascade');
            $table->enum('rol', ['principal', 'asistente_1', 'asistente_2', 'cuarto_arbitro', 'var', 'avar']);
            $table->boolean('confirmado')->default(false);
            $table->text('observaciones')->nullable();
            $table->timestamps();
            
            // Índice único para evitar que un árbitro tenga múltiples roles en el mismo grupo
            $table->unique(['grupo_arbitral_id', 'arbitro_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones_arbitrales');
    }
};
