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
        Schema::create('grupos_arbitrales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partido_id')->constrained('partidos')->onDelete('cascade');
            $table->string('nombre')->nullable(); // Nombre del grupo (opcional)
            $table->enum('tipo', ['trio', 'cuarteta', 'var']); // Tipo de grupo arbitral
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos_arbitrales');
    }
};
