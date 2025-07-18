<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Jornada;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JornadasList extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = '';
    public $temporadaFilter = '';
    public $divisionFilter = '';
    public $sortField = 'nombre';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'temporadaFilter' => ['except' => ''],
        'divisionFilter' => ['except' => ''],
        'sortField' => ['except' => 'nombre'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function mount()
    {
        $this->authorize('viewAny', Jornada::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTemporadaFilter()
    {
        $this->resetPage();
    }

    public function updatingDivisionFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function deleteJornada($jornadaId)
    {
        $jornada = Jornada::findOrFail($jornadaId);
        $this->authorize('delete', $jornada);
        
        $jornada->delete();
        
        session()->flash('message', 'Jornada eliminada exitosamente.');
    }

    public function render()
    {
        $jornadas = Jornada::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('temporada', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->temporadaFilter, function ($query) {
                $query->where('temporada', $this->temporadaFilter);
            })
            ->when($this->divisionFilter, function ($query) {
                $query->where('division', $this->divisionFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $temporadas = Jornada::distinct()->pluck('temporada')->filter()->sort();
        $divisiones = ['Primera', 'Segunda', 'Tercera'];

        return view('livewire.jornadas-list', [
            'jornadas' => $jornadas,
            'temporadas' => $temporadas,
            'divisiones' => $divisiones,
        ]);
    }
}
