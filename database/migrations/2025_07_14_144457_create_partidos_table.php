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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jornada_id')->constrained('jornadas')->onDelete('cascade');
            $table->foreignId('equipo_local_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('equipo_visitante_id')->constrained('equipos')->onDelete('cascade');
            $table->string('sede'); // Estadio donde se juega
            $table->date('fecha');
            $table->time('hora');
            $table->enum('estado', ['programado', 'en_curso', 'finalizado', 'suspendido', 'cancelado'])->default('programado');
            $table->integer('goles_local')->nullable();
            $table->integer('goles_visitante')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
