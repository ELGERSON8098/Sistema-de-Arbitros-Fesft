<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'logo',
        'sede',
        'ubicacion',
        'latitud',
        'longitud',
        'division',
        'colores_local',
        'colores_visitante',
        'observaciones',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
        'latitud' => 'decimal:8',
        'longitud' => 'decimal:8'
    ];

    // Relaciones
    public function partidosLocal()
    {
        return $this->hasMany(Partido::class, 'equipo_local_id');
    }

    public function partidosVisitante()
    {
        return $this->hasMany(Partido::class, 'equipo_visitante_id');
    }

    public function partidos()
    {
        return $this->partidosLocal->merge($this->partidosVisitante);
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    public function scopePorDivision($query, $division)
    {
        return $query->where('division', $division);
    }
}
