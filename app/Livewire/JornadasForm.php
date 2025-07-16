<?php

namespace App\Livewire;

use App\Models\Jornada;
use Livewire\Component;

class JornadasForm extends Component
{
    public $jornadaId;
    public $nombre;
    public $temporada;
    public $division;
    public $fecha_inicio;
    public $fecha_fin;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'temporada' => 'required|string|max:255',
        'division' => 'required|string|in:Primera,Segunda,Tercera',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ];

    public function mount($jornada = null)
    {
        if ($jornada) {
            $this->jornadaId = $jornada->id;
            $this->nombre = $jornada->nombre;
            $this->temporada = $jornada->temporada;
            $this->division = $jornada->division;
            $this->fecha_inicio = $jornada->fecha_inicio->format('Y-m-d');
            $this->fecha_fin = $jornada->fecha_fin->format('Y-m-d');
        } else {
            // Valores por defecto
            $this->temporada = date('Y');
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->jornadaId) {
            $jornada = Jornada::find($this->jornadaId);
            $jornada->update([
                'nombre' => $this->nombre,
                'temporada' => $this->temporada,
                'division' => $this->division,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
            ]);

            session()->flash('message', 'Jornada actualizada exitosamente.');
        } else {
            Jornada::create([
                'nombre' => $this->nombre,
                'temporada' => $this->temporada,
                'division' => $this->division,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
            ]);

            session()->flash('message', 'Jornada creada exitosamente.');
        }

        return redirect()->route('jornadas.index');
    }

    public function render()
    {
        return view('livewire.jornadas-form');
    }
}

