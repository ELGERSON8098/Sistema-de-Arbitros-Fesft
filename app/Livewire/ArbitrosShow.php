<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Arbitro;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArbitrosShow extends Component
{
    use AuthorizesRequests;

    public $arbitro;

    public function mount(Arbitro $arbitro)
    {
        $this->authorize("view", $arbitro);
        $this->arbitro = $arbitro;
    }

    public function render()
    {
        return view("livewire.arbitros-show");
    }
}


