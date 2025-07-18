<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Equipo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EquiposShow extends Component
{
    use AuthorizesRequests;

    public $equipo;

    public function mount(Equipo $equipo)
    {
        $this->authorize("view", $equipo);
        $this->equipo = $equipo;
    }

    public function render()
    {
        return view("livewire.equipos-show");
    }
}

