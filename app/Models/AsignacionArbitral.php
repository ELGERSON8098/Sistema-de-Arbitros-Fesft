<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionArbitral extends Model
{
    use HasFactory;

    protected $table = 'asignaciones_arbitrales';

    protected $fillable = [
        'grupo_arbitral_id',
        'arbitro_id',
        'rol',
        'confirmado',
        'observaciones'
    ];

    protected $casts = [
        'confirmado' => 'boolean'
    ];

    // Relaciones
    public function grupoArbitral()
    {
        return $this->belongsTo(GrupoArbitral::class);
    }

    public function arbitro()
    {
        return $this->belongsTo(Arbitro::class);
    }

    public function partido()
    {
        return $this->hasOneThrough(Partido::class, GrupoArbitral::class, 'id', 'id', 'grupo_arbitral_id', 'partido_id');
    }

    // Scopes
    public function scopePorRol($query, $rol)
    {
        return $query->where('rol', $rol);
    }

    public function scopeConfirmados($query)
    {
        return $query->where('confirmado', true);
    }

    // Accessors
    public function getRolFormateadoAttribute()
    {
        $roles = [
            'principal' => 'Árbitro Principal',
            'asistente_1' => 'Asistente 1',
            'asistente_2' => 'Asistente 2',
            'cuarto_arbitro' => 'Cuarto Árbitro',
            'var' => 'VAR',
            'avar' => 'AVAR'
        ];

        return $roles[$this->rol] ?? $this->rol;
    }
}
