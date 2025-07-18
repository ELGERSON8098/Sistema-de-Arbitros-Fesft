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
        Schema::create('jornadas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // ej. "Jornada 5"
            $table->integer('numero');
            $table->enum('division', ['Primera', 'Segunda', 'Tercera']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('temporada'); // ej. "2025"
            $table->text('descripcion')->nullable();
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jornadas');
    }
};
