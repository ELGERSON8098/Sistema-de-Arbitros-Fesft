<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Partido;
use App\Models\Jornada;

class DesignacionesPublicas extends Component
{
    use WithPagination;

    public $search = '';
    public $jornadaFilter = '';
    public $divisionFilter = '';
    public $fechaFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'jornadaFilter' => ['except' => ''],
        'divisionFilter' => ['except' => ''],
        'fechaFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingJornadaFilter()
    {
        $this->resetPage();
    }

    public function updatingDivisionFilter()
    {
        $this->resetPage();
    }

    public function updatingFechaFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Partido::with(['equipoLocal', 'equipoVisitante', 'jornada']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('equipoLocal', function ($eq) {
                    $eq->where('nombre', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('equipoVisitante', function ($eq) {
                    $eq->where('nombre', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('jornada', function ($jq) {
                    $jq->where('nombre', 'like', '%' . $this->search . '%');
                });
            });
        }

        if ($this->jornadaFilter) {
            $query->where('jornada_id', $this->jornadaFilter);
        }

        if ($this->divisionFilter) {
            $query->whereHas('jornada', function ($q) {
                $q->where('division', $this->divisionFilter);
            });
        }

        if ($this->fechaFilter) {
            $query->whereDate('fecha', $this->fechaFilter);
        }

        $partidos = $query->orderBy('fecha', 'desc')
                         ->orderBy('hora', 'desc')
                         ->paginate(12);

        // Obtener datos para filtros
        $jornadas = Jornada::orderBy('nombre')->get();
        $divisiones = ['Primera', 'Segunda', 'Tercera'];

        return view('livewire.designaciones-publicas', [
            'partidos' => $partidos,
            'jornadas' => $jornadas,
            'divisiones' => $divisiones,
        ]);
    }
}

