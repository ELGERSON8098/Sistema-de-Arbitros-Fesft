<?php

namespace App\Livewire;

use App\Models\Equipo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EquiposForm extends Component
{
    use WithFileUploads;

    public $equipoId;
    public $nombre;
    public $division;
    public $sede;
    public $ubicacion;
    public $logo;
    public $currentLogo;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'division' => 'required|string|in:Primera,Segunda,Tercera',
        'sede' => 'required|string|max:255',
        'ubicacion' => 'required|string|max:255',
        'logo' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function mount($equipo = null)
    {
        if ($equipo) {
            $this->equipoId = $equipo->id;
            $this->nombre = $equipo->nombre;
            $this->division = $equipo->division;
            $this->sede = $equipo->sede;
            $this->ubicacion = $equipo->ubicacion;
            $this->currentLogo = $equipo->logo;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->equipoId) {
            $equipo = Equipo::find($this->equipoId);
            $equipo->update([
                'nombre' => $this->nombre,
                'division' => $this->division,
                'sede' => $this->sede,
                'ubicacion' => $this->ubicacion,
            ]);

            if ($this->logo) {
                if ($this->currentLogo) {
                    Storage::disk('public')->delete($this->currentLogo);
                }
                $equipo->logo = $this->logo->store('logos_equipos', 'public');
                $equipo->save();
            }

            session()->flash('message', 'Equipo actualizado exitosamente.');
        } else {
            $equipo = Equipo::create([
                'nombre' => $this->nombre,
                'division' => $this->division,
                'sede' => $this->sede,
                'ubicacion' => $this->ubicacion,
            ]);

            if ($this->logo) {
                $equipo->logo = $this->logo->store('logos_equipos', 'public');
                $equipo->save();
            }

            session()->flash('message', 'Equipo creado exitosamente.');
        }

        return redirect()->route('equipos.index');
    }

    public function render()
    {
        return view('livewire.equipos-form');
    }
}

