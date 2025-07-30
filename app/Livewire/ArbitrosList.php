<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Arbitro;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArbitrosList extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = "";
    public $categoriaFilter = "";
    public $estadoFilter = "";
    public $ubicacionFilter = "";
    public $sortField = "nombre";
    public $sortDirection = "asc";
    public $perPage = 10;
    
    // Variables para el modal de confirmación
    public $showDeleteModal = false;
    public $arbitroToDelete = null;

    protected $queryString = [
        "search" => ["except" => ""],
        "categoriaFilter" => ["except" => ""],
        "estadoFilter" => ["except" => ""],
        "ubicacionFilter" => ["except" => ""],
        "sortField" => ["except" => "nombre"],
        "sortDirection" => ["except" => "asc"],
    ];

    public function mount()
    {
        $this->authorize("viewAny", Arbitro::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoriaFilter()
    {
        $this->resetPage();
    }

    public function updatingEstadoFilter()
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
            $this->sortDirection = $this->sortDirection === "asc" ? "desc" : "asc";
        } else {
            $this->sortDirection = "asc";
        }
        $this->sortField = $field;
    }

    public function confirmDelete($arbitroId)
    {
        $arbitro = Arbitro::findOrFail($arbitroId);
        $this->authorize("delete", $arbitro);
        
        $this->arbitroToDelete = $arbitro;
        $this->showDeleteModal = true;
    }
    
    public function deleteArbitro()
    {
        if ($this->arbitroToDelete) {
            $this->arbitroToDelete->delete();
            session()->flash("message", "Árbitro eliminado exitosamente.");
            
            $this->showDeleteModal = false;
            $this->arbitroToDelete = null;
        }
    }
    
    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->arbitroToDelete = null;
    }

    public function toggleEstado($arbitroId)
    {
        $arbitro = Arbitro::findOrFail($arbitroId);
        $this->authorize("update", $arbitro);
        
        $arbitro->update([
            // Cambiar entre 'Disponible' y 'Ocupado'
            'estado' => $arbitro->estado === 'Disponible' ? 'Ocupado' : 'Disponible'
        ]);
        
        session()->flash("message", "Estado del árbitro actualizado.");
    }

    public function render()
    {
        $arbitros = Arbitro::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where("nombre", "like", "%" . $this->search . "%")
                      ->orWhere("apellido", "like", "%" . $this->search . "%");
                });
            })
            ->when($this->categoriaFilter, function ($query) {
                $query->where("categoria", $this->categoriaFilter);
            })
            ->when($this->estadoFilter, function ($query) {
                $query->where("estado", $this->estadoFilter);
            })
            ->when($this->ubicacionFilter, function ($query) {
                $query->where("ubicacion", "like", "%" . $this->ubicacionFilter . "%");
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $categorias = ["FIFA", "Primera", "Segunda", "Tercera"];
        $estados = ["Disponible", "Ocupado", "Inactivo"];
        $ubicaciones = Arbitro::distinct()->pluck("ubicacion")->filter()->sort();

        return view("livewire.arbitros-list", [
            "arbitros" => $arbitros,
            "categorias" => $categorias,
            "estados" => $estados,
            "ubicaciones" => $ubicaciones,
        ]);
    }
}


