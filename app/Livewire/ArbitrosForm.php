<?php

namespace App\Livewire;

use App\Models\Arbitro;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ArbitrosForm extends Component
{
    use WithFileUploads;

    public $arbitroId;
    public $nombre;
    public $apellido;
    public $categoria;
    public $estado;
    public $ubicacion;
    public $foto;
    public $currentFoto;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'categoria' => 'required|string|in:FIFA,Primera,Segunda,Tercera',
        'estado' => 'required|string|in:Disponible,Ocupado,Inactivo',
        'ubicacion' => 'required|string|max:255',
        'foto' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function mount($arbitro = null)
    {
        if ($arbitro) {
            $this->arbitroId = $arbitro->id;
            $this->nombre = $arbitro->nombre;
            $this->apellido = $arbitro->apellido;
            $this->categoria = $arbitro->categoria;
            $this->estado = $arbitro->estado;
            $this->ubicacion = $arbitro->ubicacion;
            $this->currentFoto = $arbitro->foto;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->arbitroId) {
            $arbitro = Arbitro::find($this->arbitroId);
            $arbitro->update([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'categoria' => $this->categoria,
                'estado' => $this->estado,
                'ubicacion' => $this->ubicacion,
            ]);

            if ($this->foto) {
                if ($this->currentFoto) {
                    Storage::disk('public')->delete($this->currentFoto);
                }
                $arbitro->foto = $this->foto->store('fotos_arbitros', 'public');
                $arbitro->save();
            }

            session()->flash('message', 'Árbitro actualizado exitosamente.');
        } else {
            $arbitro = Arbitro::create([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'categoria' => $this->categoria,
                'estado' => $this->estado,
                'ubicacion' => $this->ubicacion,
            ]);

            if ($this->foto) {
                $arbitro->foto = $this->foto->store('fotos_arbitros', 'public');
                $arbitro->save();
            }

            session()->flash('message', 'Árbitro creado exitosamente.');
        }

        return redirect()->route('arbitros.index');
    }

    public function render()
    {
        return view('livewire.arbitros-form');
    }
}


