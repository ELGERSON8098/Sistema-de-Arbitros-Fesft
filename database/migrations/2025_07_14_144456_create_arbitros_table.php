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
        Schema::create('arbitros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->enum('categoria', ['FIFA', 'Primera', 'Segunda', 'Tercera']);
            $table->string('foto')->nullable();
            $table->enum('estado', ['disponible', 'ocupado', 'inactivo'])->default('disponible');
            $table->string('ubicacion'); // Ciudad/Departamento
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->integer('partidos_arbitrados')->default(0);
            $table->date('fecha_ultima_designacion')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arbitros');
    }
};
