<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Arbitro;
use App\Models\Equipo;
use App\Models\Partido;
use App\Models\Jornada;
use App\Models\GrupoArbitral;
use App\Models\AsignacionArbitral;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $estadisticasGenerales;
    public $arbitrosMasDesignados;
    public $partidosPorMes;
    public $asignacionesPorDivision;
    public $arbitrosPorCategoria;

    public function mount()
    {
        $this->cargarEstadisticas();
    }

    public function cargarEstadisticas()
    {
        $this->estadisticasGenerales = $this->obtenerEstadisticasGenerales();
        $this->arbitrosMasDesignados = $this->obtenerArbitrosMasDesignados();
        $this->partidosPorMes = $this->obtenerPartidosPorMes();
        $this->asignacionesPorDivision = $this->obtenerAsignacionesPorDivision();
        $this->arbitrosPorCategoria = $this->obtenerArbitrosPorCategoria();
    }

    private function obtenerEstadisticasGenerales()
    {
        $totalArbitros = Arbitro::count();
        $arbitrosActivos = Arbitro::where('activo', true)->count();
        $arbitrosDisponibles = Arbitro::where('estado', 'disponible')->where('activo', true)->count();

        $totalEquipos = Equipo::count();
        $totalPartidos = Partido::count();
        $totalGruposArbitrales = GrupoArbitral::count();

        $totalJornadas = Jornada::count();
        $jornadasActivas = Jornada::where('activa', true)->count();

        $totalAsignaciones = AsignacionArbitral::count();

        return [
            'total_arbitros' => $totalArbitros,
            'arbitros_activos' => $arbitrosActivos,
            'arbitros_disponibles' => $arbitrosDisponibles,
            'total_equipos' => $totalEquipos,
            'total_partidos' => $totalPartidos,
            'total_grupos_arbitrales' => $totalGruposArbitrales,
            'total_jornadas' => $totalJornadas,
            'jornadas_activas' => $jornadasActivas,
            'total_asignaciones' => $totalAsignaciones,
            'porcentaje_disponibilidad' => $totalArbitros > 0 ? round(($arbitrosDisponibles / $totalArbitros) * 100, 1) : 0
        ];
    }

    private function obtenerArbitrosMasDesignados()
    {
        return Arbitro::select('nombre', 'apellido', 'categoria')
            ->withCount('asignaciones')
            ->orderBy('asignaciones_count', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($arbitro) {
                return [
                    'nombre' => $arbitro->nombre . ' ' . $arbitro->apellido,
                    'categoria' => $arbitro->categoria,
                    'asignaciones' => $arbitro->asignaciones_count ?? 0
                ];
            });
    }

    private function obtenerPartidosPorMes()
    {
        $partidosPorMes = Partido::selectRaw('MONTH(fecha) as mes, COUNT(*) as total')
            ->whereYear('fecha', Carbon::now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $datos = [];

        for ($i = 1; $i <= 12; $i++) {
            $partido = $partidosPorMes->firstWhere('mes', $i);
            $datos[] = [
                'mes' => $meses[$i - 1],
                'partidos' => $partido ? $partido->total : 0
            ];
        }

        return $datos;
    }

    private function obtenerAsignacionesPorDivision()
    {
        $equiposPrimera = Equipo::where('division', 'Primera')->count();
        $equiposSegunda = Equipo::where('division', 'Segunda')->count();
        $equiposTercera = Equipo::where('division', 'Tercera')->count();

        return [
            ['division' => 'Primera', 'equipos' => $equiposPrimera],
            ['division' => 'Segunda', 'equipos' => $equiposSegunda],
            ['division' => 'Tercera', 'equipos' => $equiposTercera]
        ];
    }

    private function obtenerArbitrosPorCategoria()
    {
        return Arbitro::selectRaw('categoria, COUNT(*) as total')
            ->groupBy('categoria')
            ->get()
            ->map(function ($item) {
                return [
                    'categoria' => $item->categoria,
                    'total' => $item->total
                ];
            });
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

