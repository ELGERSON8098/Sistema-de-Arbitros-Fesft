<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = [
        'jornada_id',
        'equipo_local_id',
        'equipo_visitante_id',
        'sede',
        'fecha',
        'hora',
        'estado',
        'goles_local',
        'goles_visitante',
        'observaciones'
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i'
    ];

    // Relaciones
    public function jornada()
    {
        return $this->belongsTo(Jornada::class);
    }

    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }

    public function grupoArbitral()
    {
        return $this->hasOne(GrupoArbitral::class);
    }

    public function arbitros()
    {
        return $this->hasManyThrough(
            Arbitro::class,
            AsignacionArbitral::class,
            'grupo_arbitral_id',
            'id',
            'id',
            'arbitro_id'
        )->join('grupos_arbitrales', 'grupos_arbitrales.partido_id', '=', 'partidos.id');
    }

    // Scopes
    public function scopePorFecha($query, $fecha)
    {
        return $query->where('fecha', $fecha);
    }

    public function scopePorEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    public function scopePorJornada($query, $jornadaId)
    {
        return $query->where('jornada_id', $jornadaId);
    }

    // Accessors
    public function getFechaHoraAttribute()
    {
        return $this->fecha->format('d/m/Y') . ' ' . $this->hora->format('H:i');
    }
}
