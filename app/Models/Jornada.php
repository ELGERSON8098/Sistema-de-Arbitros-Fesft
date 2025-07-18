<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'numero',
        'division',
        'fecha_inicio',
        'fecha_fin',
        'temporada',
        'descripcion',
        'activa'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activa' => 'boolean'
    ];

    // Relaciones
    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }

    // Scopes
    public function scopeActivas($query)
    {
        return $query->where('activa', true);
    }

    public function scopePorDivision($query, $division)
    {
        return $query->where('division', $division);
    }

    public function scopePorTemporada($query, $temporada)
    {
        return $query->where('temporada', $temporada);
    }
}
