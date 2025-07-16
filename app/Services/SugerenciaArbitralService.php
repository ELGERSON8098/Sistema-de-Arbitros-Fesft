<?php

namespace App\Services;

use App\Models\Arbitro;
use App\Models\Partido;
use App\Models\AsignacionArbitral;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SugerenciaArbitralService
{
    /**
     * Genera sugerencias de árbitros para un partido específico
     */
    public function sugerirArbitrosParaPartido(Partido $partido): array
    {
        $arbitrosDisponibles = $this->obtenerArbitrosDisponibles($partido);
        
        $sugerencias = [
            'arbitro_principal' => $this->sugerirArbitroPrincipal($partido, $arbitrosDisponibles),
            'asistente_1' => $this->sugerirAsistente($partido, $arbitrosDisponibles, 1),
            'asistente_2' => $this->sugerirAsistente($partido, $arbitrosDisponibles, 2),
            'cuarto_arbitro' => $this->sugerirCuartoArbitro($partido, $arbitrosDisponibles),
            'var' => $this->sugerirVAR($partido, $arbitrosDisponibles),
        ];

        return $sugerencias;
    }

    /**
     * Obtiene árbitros disponibles para un partido
     */
    private function obtenerArbitrosDisponibles(Partido $partido): Collection
    {
        return Arbitro::where('estado', 'disponible')
            ->where('activo', true)
            ->whereDoesntHave('asignaciones', function ($query) use ($partido) {
                $query->whereHas('partido', function ($q) use ($partido) {
                    $q->where('fecha', $partido->fecha)
                      ->where('hora', $partido->hora);
                });
            })
            ->get();
    }

    /**
     * Sugiere el árbitro principal basándose en múltiples criterios
     */
    private function sugerirArbitroPrincipal(Partido $partido, Collection $arbitros): ?Arbitro
    {
        $candidatos = $arbitros->filter(function ($arbitro) {
            return in_array($arbitro->categoria, ['FIFA', 'Primera']);
        });

        if ($candidatos->isEmpty()) {
            $candidatos = $arbitros;
        }

        return $this->seleccionarMejorCandidato($partido, $candidatos, 'arbitro_principal');
    }

    /**
     * Sugiere un árbitro asistente
     */
    private function sugerirAsistente(Partido $partido, Collection $arbitros, int $numero): ?Arbitro
    {
        $candidatos = $arbitros->filter(function ($arbitro) {
            return in_array($arbitro->categoria, ['FIFA', 'Primera', 'Segunda']);
        });

        if ($candidatos->isEmpty()) {
            $candidatos = $arbitros;
        }

        return $this->seleccionarMejorCandidato($partido, $candidatos, "asistente_{$numero}");
    }

    /**
     * Sugiere el cuarto árbitro
     */
    private function sugerirCuartoArbitro(Partido $partido, Collection $arbitros): ?Arbitro
    {
        return $this->seleccionarMejorCandidato($partido, $arbitros, 'cuarto_arbitro');
    }

    /**
     * Sugiere el árbitro VAR
     */
    private function sugerirVAR(Partido $partido, Collection $arbitros): ?Arbitro
    {
        $candidatos = $arbitros->filter(function ($arbitro) {
            return $arbitro->categoria === 'FIFA';
        });

        if ($candidatos->isEmpty()) {
            $candidatos = $arbitros->filter(function ($arbitro) {
                return $arbitro->categoria === 'Primera';
            });
        }

        return $this->seleccionarMejorCandidato($partido, $candidatos, 'var');
    }

    /**
     * Selecciona el mejor candidato basándose en múltiples criterios
     */
    private function seleccionarMejorCandidato(Partido $partido, Collection $candidatos, string $rol): ?Arbitro
    {
        if ($candidatos->isEmpty()) {
            return null;
        }

        $puntuaciones = [];

        foreach ($candidatos as $arbitro) {
            $puntuacion = 0;

            // Criterio 1: Proximidad geográfica (40% del peso)
            $puntuacion += $this->calcularPuntuacionProximidad($arbitro, $partido) * 0.4;

            // Criterio 2: Carga reciente de partidos (30% del peso)
            $puntuacion += $this->calcularPuntuacionCarga($arbitro) * 0.3;

            // Criterio 3: Categoría del árbitro (20% del peso)
            $puntuacion += $this->calcularPuntuacionCategoria($arbitro, $partido) * 0.2;

            // Criterio 4: Rotación equitativa (10% del peso)
            $puntuacion += $this->calcularPuntuacionRotacion($arbitro, $partido) * 0.1;

            $puntuaciones[$arbitro->id] = $puntuacion;
        }

        // Ordenar por puntuación descendente y devolver el mejor
        arsort($puntuaciones);
        $mejorArbitroId = array_key_first($puntuaciones);

        return $candidatos->find($mejorArbitroId);
    }

    /**
     * Calcula puntuación basada en proximidad geográfica
     */
    private function calcularPuntuacionProximidad(Arbitro $arbitro, Partido $partido): float
    {
        if (!$arbitro->latitud || !$arbitro->longitud || 
            !$partido->equipo_local->latitud || !$partido->equipo_local->longitud) {
            return 0.5; // Puntuación neutral si no hay coordenadas
        }

        $distancia = $this->calcularDistanciaHaversine(
            $arbitro->latitud,
            $arbitro->longitud,
            $partido->equipo_local->latitud,
            $partido->equipo_local->longitud
        );

        // Convertir distancia a puntuación (más cerca = mayor puntuación)
        // Máximo 100km para puntuación completa
        return max(0, 1 - ($distancia / 100));
    }

    /**
     * Calcula la distancia entre dos puntos usando la fórmula de Haversine
     */
    private function calcularDistanciaHaversine(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $radioTierra = 6371; // Radio de la Tierra en kilómetros

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $radioTierra * $c;
    }

    /**
     * Calcula puntuación basada en carga reciente de partidos
     */
    private function calcularPuntuacionCarga(Arbitro $arbitro): float
    {
        $fechaLimite = Carbon::now()->subDays(30);
        
        $partidosRecientes = AsignacionArbitral::where('arbitro_id', $arbitro->id)
            ->whereHas('partido', function ($query) use ($fechaLimite) {
                $query->where('fecha', '>=', $fechaLimite);
            })
            ->count();

        // Menos partidos recientes = mayor puntuación
        // Máximo 8 partidos por mes para puntuación mínima
        return max(0, 1 - ($partidosRecientes / 8));
    }

    /**
     * Calcula puntuación basada en la categoría del árbitro
     */
    private function calcularPuntuacionCategoria(Arbitro $arbitro, Partido $partido): float
    {
        $categoriasPuntuacion = [
            'FIFA' => 1.0,
            'Primera' => 0.8,
            'Segunda' => 0.6,
            'Tercera' => 0.4,
        ];

        return $categoriasPuntuacion[$arbitro->categoria] ?? 0.2;
    }

    /**
     * Calcula puntuación basada en rotación equitativa
     */
    private function calcularPuntuacionRotacion(Arbitro $arbitro, Partido $partido): float
    {
        // Verificar si el árbitro ha dirigido partidos de estos equipos recientemente
        $fechaLimite = Carbon::now()->subDays(60);
        
        $partidosEquipos = AsignacionArbitral::where('arbitro_id', $arbitro->id)
            ->whereHas('partido', function ($query) use ($partido, $fechaLimite) {
                $query->where('fecha', '>=', $fechaLimite)
                      ->where(function ($q) use ($partido) {
                          $q->where('equipo_local_id', $partido->equipo_local_id)
                            ->orWhere('equipo_visitante_id', $partido->equipo_visitante_id);
                      });
            })
            ->count();

        // Menos partidos con estos equipos = mayor puntuación
        return max(0, 1 - ($partidosEquipos / 3));
    }

    /**
     * Valida que no haya conflictos en las asignaciones
     */
    public function validarAsignaciones(Partido $partido, array $asignaciones): array
    {
        $errores = [];

        // Verificar que no se repitan árbitros
        $arbitrosAsignados = array_filter($asignaciones);
        if (count($arbitrosAsignados) !== count(array_unique($arbitrosAsignados))) {
            $errores[] = 'No se puede asignar el mismo árbitro a múltiples roles.';
        }

        // Verificar disponibilidad en la fecha/hora
        foreach ($asignaciones as $rol => $arbitroId) {
            if ($arbitroId) {
                $arbitro = Arbitro::find($arbitroId);
                if (!$arbitro || $arbitro->estado !== 'disponible') {
                    $errores[] = "El árbitro para {$rol} no está disponible.";
                }

                // Verificar conflictos de horario
                $conflicto = AsignacionArbitral::where('arbitro_id', $arbitroId)
                    ->whereHas('partido', function ($query) use ($partido) {
                        $query->where('fecha', $partido->fecha)
                              ->where('hora', $partido->hora);
                    })
                    ->exists();

                if ($conflicto) {
                    $errores[] = "El árbitro para {$rol} ya tiene un partido asignado en esa fecha y hora.";
                }
            }
        }

        return $errores;
    }

    /**
     * Genera estadísticas del motor de sugerencias
     */
    public function generarEstadisticas(): array
    {
        $totalPartidos = Partido::count();
        $partidosConAsignaciones = Partido::whereHas('asignaciones')->count();
        
        $arbitrosMasActivos = Arbitro::withCount(['asignaciones' => function ($query) {
            $query->whereHas('partido', function ($q) {
                $q->where('fecha', '>=', Carbon::now()->subDays(30));
            });
        }])
        ->orderBy('asignaciones_count', 'desc')
        ->take(10)
        ->get();

        return [
            'total_partidos' => $totalPartidos,
            'partidos_con_asignaciones' => $partidosConAsignaciones,
            'porcentaje_asignacion' => $totalPartidos > 0 ? round(($partidosConAsignaciones / $totalPartidos) * 100, 2) : 0,
            'arbitros_mas_activos' => $arbitrosMasActivos,
        ];
    }
}

