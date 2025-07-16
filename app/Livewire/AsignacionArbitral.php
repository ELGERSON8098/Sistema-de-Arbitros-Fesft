<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Partido;
use App\Models\Arbitro;
use App\Models\GrupoArbitral;
use App\Models\AsignacionArbitral as AsignacionModel;
use App\Services\SugerenciaArbitralService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AsignacionArbitral extends Component
{
    use AuthorizesRequests;

    public $partido;
    public $arbitroPrincipal = null;
    public $asistente1 = null;
    public $asistente2 = null;
    public $cuartoArbitro = null;
    public $var = null;
    
    public $sugerencias = [];
    public $mostrarSugerencias = false;
    public $errores = [];

    protected $rules = [
        'arbitroPrincipal' => 'nullable|exists:arbitros,id',
        'asistente1' => 'nullable|exists:arbitros,id',
        'asistente2' => 'nullable|exists:arbitros,id',
        'cuartoArbitro' => 'nullable|exists:arbitros,id',
        'var' => 'nullable|exists:arbitros,id',
    ];

    public function mount(Partido $partido)
    {
        $this->authorize('create', AsignacionModel::class);
        $this->partido = $partido;
        $this->cargarAsignacionesExistentes();
    }

    public function cargarAsignacionesExistentes()
    {
        if ($this->partido->grupo_arbitral_id) {
            $asignaciones = AsignacionModel::where('grupo_arbitral_id', $this->partido->grupo_arbitral_id)->get();
            
            foreach ($asignaciones as $asignacion) {
                switch ($asignacion->rol) {
                    case 'arbitro_principal':
                        $this->arbitroPrincipal = $asignacion->arbitro_id;
                        break;
                    case 'asistente_1':
                        $this->asistente1 = $asignacion->arbitro_id;
                        break;
                    case 'asistente_2':
                        $this->asistente2 = $asignacion->arbitro_id;
                        break;
                    case 'cuarto_arbitro':
                        $this->cuartoArbitro = $asignacion->arbitro_id;
                        break;
                    case 'var':
                        $this->var = $asignacion->arbitro_id;
                        break;
                }
            }
        }
    }

    public function generarSugerencias()
    {
        $servicio = new SugerenciaArbitralService();
        $this->sugerencias = $servicio->sugerirArbitrosParaPartido($this->partido);
        $this->mostrarSugerencias = true;
        
        session()->flash('message', 'Sugerencias generadas exitosamente.');
    }

    public function aplicarSugerencia($rol)
    {
        if (isset($this->sugerencias[$rol]) && $this->sugerencias[$rol]) {
            $arbitroId = $this->sugerencias[$rol]->id;
            
            switch ($rol) {
                case 'arbitro_principal':
                    $this->arbitroPrincipal = $arbitroId;
                    break;
                case 'asistente_1':
                    $this->asistente1 = $arbitroId;
                    break;
                case 'asistente_2':
                    $this->asistente2 = $arbitroId;
                    break;
                case 'cuarto_arbitro':
                    $this->cuartoArbitro = $arbitroId;
                    break;
                case 'var':
                    $this->var = $arbitroId;
                    break;
            }
        }
    }

    public function aplicarTodasLasSugerencias()
    {
        foreach ($this->sugerencias as $rol => $arbitro) {
            if ($arbitro) {
                $this->aplicarSugerencia($rol);
            }
        }
        
        session()->flash('message', 'Todas las sugerencias han sido aplicadas.');
    }

    public function guardarAsignaciones()
    {
        $this->validate();

        $asignaciones = [
            'arbitro_principal' => $this->arbitroPrincipal,
            'asistente_1' => $this->asistente1,
            'asistente_2' => $this->asistente2,
            'cuarto_arbitro' => $this->cuartoArbitro,
            'var' => $this->var,
        ];

        // Validar que al menos haya un árbitro principal
        if (!$this->arbitroPrincipal) {
            $this->errores = ['Se requiere al menos un árbitro principal.'];
            return;
        }

        // Validar que no se repitan árbitros
        $arbitrosAsignados = array_filter($asignaciones);
        if (count($arbitrosAsignados) !== count(array_unique($arbitrosAsignados))) {
            $this->errores = ['No se puede asignar el mismo árbitro a múltiples roles.'];
            return;
        }

        // Crear o actualizar grupo arbitral
        if ($this->partido->grupo_arbitral_id) {
            $grupoArbitral = GrupoArbitral::find($this->partido->grupo_arbitral_id);
            // Eliminar asignaciones existentes
            AsignacionModel::where('grupo_arbitral_id', $grupoArbitral->id)->delete();
        } else {
            $grupoArbitral = GrupoArbitral::create([
                'nombre' => 'Grupo ' . $this->partido->local->nombre . ' vs ' . $this->partido->visitante->nombre,
            ]);
            $this->partido->update(['grupo_arbitral_id' => $grupoArbitral->id]);
        }

        // Crear nuevas asignaciones
        foreach ($asignaciones as $rol => $arbitroId) {
            if ($arbitroId) {
                AsignacionModel::create([
                    'grupo_arbitral_id' => $grupoArbitral->id,
                    'arbitro_id' => $arbitroId,
                    'rol' => $rol,
                ]);
            }
        }

        session()->flash('message', 'Asignaciones guardadas exitosamente.');
        $this->errores = [];
        
        return redirect()->route('partidos.show', $this->partido);
    }

    public function limpiarAsignaciones()
    {
        $this->arbitroPrincipal = null;
        $this->asistente1 = null;
        $this->asistente2 = null;
        $this->cuartoArbitro = null;
        $this->var = null;
        $this->errores = [];
    }

    public function render()
    {
        $arbitrosDisponibles = Arbitro::where('estado', 'Disponible')
            ->orderBy('nombre')
            ->get();

        return view('livewire.asignacion-arbitral', [
            'arbitrosDisponibles' => $arbitrosDisponibles,
        ]);
    }
}

