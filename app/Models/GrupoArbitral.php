<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoArbitral extends Model
{
    use HasFactory;

    protected $table = 'grupos_arbitrales';

    protected $fillable = [
        'partido_id',
        'nombre',
        'tipo',
        'observaciones'
    ];

    // Relaciones
    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function asignaciones()
    {
        return $this->hasMany(AsignacionArbitral::class);
    }

    public function arbitros()
    {
        return $this->belongsToMany(Arbitro::class, 'asignaciones_arbitrales')
                    ->withPivot('rol', 'confirmado', 'observaciones')
                    ->withTimestamps();
    }

    // Métodos de conveniencia
    public function arbitroPrincipal()
    {
        return $this->asignaciones()->where('rol', 'principal')->first()?->arbitro;
    }

    public function asistentes()
    {
        return $this->asignaciones()->whereIn('rol', ['asistente_1', 'asistente_2'])->get()->pluck('arbitro');
    }

    public function cuartoArbitro()
    {
        return $this->asignaciones()->where('rol', 'cuarto_arbitro')->first()?->arbitro;
    }

    public function var()
    {
        return $this->asignaciones()->where('rol', 'var')->first()?->arbitro;
    }
}
