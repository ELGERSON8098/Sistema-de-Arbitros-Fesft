<?php

namespace App\Livewire;

use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Jornada;
use Livewire\Component;

class PartidosForm extends Component
{
    public $partidoId;
    public $jornada_id;
    public $local_id;
    public $visitante_id;
    public $fecha;
    public $hora;
    public $sede;

    protected $rules = [
        'jornada_id' => 'required|exists:jornadas,id',
        'local_id' => 'required|exists:equipos,id',
        'visitante_id' => 'required|exists:equipos,id|different:local_id',
        'fecha' => 'required|date',
        'hora' => 'required',
        'sede' => 'required|string|max:255',
    ];

    public function mount($partido = null)
    {
        if ($partido) {
            $this->partidoId = $partido->id;
            $this->jornada_id = $partido->jornada_id;
            $this->local_id = $partido->local_id;
            $this->visitante_id = $partido->visitante_id;
            $this->fecha = $partido->fecha->format('Y-m-d');
            $this->hora = $partido->hora;
            $this->sede = $partido->sede;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->partidoId) {
            $partido = Partido::find($this->partidoId);
            $partido->update([
                'jornada_id' => $this->jornada_id,
                'local_id' => $this->local_id,
                'visitante_id' => $this->visitante_id,
                'fecha' => $this->fecha,
                'hora' => $this->hora,
                'sede' => $this->sede,
            ]);

            session()->flash('message', 'Partido actualizado exitosamente.');
        } else {
            Partido::create([
                'jornada_id' => $this->jornada_id,
                'local_id' => $this->local_id,
                'visitante_id' => $this->visitante_id,
                'fecha' => $this->fecha,
                'hora' => $this->hora,
                'sede' => $this->sede,
            ]);

            session()->flash('message', 'Partido creado exitosamente.');
        }

        return redirect()->route('partidos.index');
    }

    public function render()
    {
        $jornadas = Jornada::orderBy('nombre')->get();
        $equipos = Equipo::orderBy('nombre')->get();

        return view('livewire.partidos-form', [
            'jornadas' => $jornadas,
            'equipos' => $equipos,
        ]);
    }
}

