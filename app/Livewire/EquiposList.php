<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EquiposList extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = '';
    public $divisionFilter = '';
    public $ubicacionFilter = '';
    public $sortField = 'nombre';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'divisionFilter' => ['except' => ''],
        'ubicacionFilter' => ['except' => ''],
        'sortField' => ['except' => 'nombre'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function mount()
    {
        $this->authorize('viewAny', Equipo::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDivisionFilter()
    {
        $this->resetPage();
    }

    public function updatingUbicacionFilter()
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

    public function deleteEquipo($equipoId)
    {
        $equipo = Equipo::findOrFail($equipoId);
        $this->authorize('delete', $equipo);
        
        $equipo->delete();
        
        session()->flash('message', 'Equipo eliminado exitosamente.');
    }

    public function render()
    {
        $equipos = Equipo::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('sede', 'like', '%' . $this->search . '%')
                      ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->divisionFilter, function ($query) {
                $query->where('division', $this->divisionFilter);
            })
            ->when($this->ubicacionFilter, function ($query) {
                $query->where('ubicacion', 'like', '%' . $this->ubicacionFilter . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $divisiones = ['Primera', 'Segunda', 'Tercera'];
        $ubicaciones = Equipo::distinct()->pluck('ubicacion')->filter()->sort();

        return view('livewire.equipos-list', [
            'equipos' => $equipos,
            'divisiones' => $divisiones,
            'ubicaciones' => $ubicaciones,
        ]);
    }
}
