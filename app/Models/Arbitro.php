<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Arbitro extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'categoria',
        'foto',
        'estado',
        'ubicacion',
        'latitud',
        'longitud',
        'partidos_arbitrados',
        'fecha_ultima_designacion',
        'observaciones',
        'activo'
    ];

    protected $casts = [
        'fecha_ultima_designacion' => 'date',
        'activo' => 'boolean',
        'latitud' => 'decimal:8',
        'longitud' => 'decimal:8'
    ];

    // Relaciones
    public function asignaciones()
    {
        return $this->hasMany(AsignacionArbitral::class);
    }

    public function partidos()
    {
        return $this->hasManyThrough(Partido::class, AsignacionArbitral::class, 'arbitro_id', 'id', 'id', 'grupo_arbitral_id')
                    ->join('grupos_arbitrales', 'grupos_arbitrales.id', '=', 'asignaciones_arbitrales.grupo_arbitral_id');
    }

    // Scopes
    public function scopeDisponibles($query)
    {
        return $query->where('estado', 'disponible')->where('activo', true);
    }

    public function scopePorCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria);
    }

    // Accessors
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
