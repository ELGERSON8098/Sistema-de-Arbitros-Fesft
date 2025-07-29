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
    public $email;
    public $telefono;
    public $categoria;
    public $estado = 'disponible'; // Valor por defecto
    public $ubicacion;
    public $latitud;
    public $longitud;
    public $observaciones;
    public $foto;
    public $currentFoto;
    public $activo = true; // Valor por defecto

    protected function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:arbitros,email' . ($this->arbitroId ? ',' . $this->arbitroId : ''),
            'telefono' => 'nullable|string|max:20',
            'categoria' => 'required|string|in:FIFA,Primera,Segunda,Tercera',
            'estado' => 'required|string|in:disponible,ocupado,inactivo',
            'ubicacion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric|between:-90,90',
            'longitud' => 'nullable|numeric|between:-180,180',
            'observaciones' => 'nullable|string',
            'foto' => 'nullable|image|max:1024', // 1MB Max
            'activo' => 'boolean',
        ];
    }

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio.',
        'apellido.required' => 'El apellido es obligatorio.',
        'email.required' => 'El email es obligatorio.',
        'email.email' => 'El email debe tener un formato válido.',
        'email.unique' => 'Este email ya está registrado por otro árbitro.',
        'categoria.required' => 'Debe seleccionar una categoría.',
        'categoria.in' => 'La categoría seleccionada no es válida.',
        'estado.required' => 'Debe seleccionar un estado.',
        'estado.in' => 'El estado seleccionado no es válido.',
        'ubicacion.required' => 'La ubicación es obligatoria.',
        'latitud.between' => 'La latitud debe estar entre -90 y 90.',
        'longitud.between' => 'La longitud debe estar entre -180 y 180.',
        'foto.image' => 'El archivo debe ser una imagen.',
        'foto.max' => 'La imagen no debe superar 1MB.',
    ];

    public function mount($arbitro = null)
    {
        if ($arbitro) {
            $this->arbitroId = $arbitro->id;
            $this->nombre = $arbitro->nombre;
            $this->apellido = $arbitro->apellido;
            $this->email = $arbitro->email;
            $this->telefono = $arbitro->telefono;
            $this->categoria = $arbitro->categoria;
            $this->estado = $arbitro->estado;
            $this->ubicacion = $arbitro->ubicacion;
            $this->latitud = $arbitro->latitud;
            $this->longitud = $arbitro->longitud;
            $this->observaciones = $arbitro->observaciones;
            $this->activo = $arbitro->activo;
            $this->currentFoto = $arbitro->foto;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'categoria' => $this->categoria,
            'estado' => $this->estado,
            'ubicacion' => $this->ubicacion,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'observaciones' => $this->observaciones,
            'activo' => $this->activo,
        ];

        if ($this->arbitroId) {
            $arbitro = Arbitro::find($this->arbitroId);
            $arbitro->update($data);

            if ($this->foto) {
                if ($this->currentFoto) {
                    Storage::disk('public')->delete($this->currentFoto);
                }
                $arbitro->foto = $this->foto->store('fotos_arbitros', 'public');
                $arbitro->save();
            }

            session()->flash('message', 'Árbitro actualizado exitosamente.');
        } else {
            $arbitro = Arbitro::create($data);

            if ($this->foto) {
                $arbitro->foto = $this->foto->store('fotos_arbitros', 'public');
                $arbitro->save();
            }

            session()->flash('message', 'Árbitro creado exitosamente.');
        }

        return redirect()->route('arbitros.index');
    }

    public function updatedEmail()
    {
        $this->validateOnly('email');
    }

    public function updatedLatitud()
    {
        $this->validateOnly('latitud');
    }

    public function updatedLongitud()
    {
        $this->validateOnly('longitud');
    }

    public function updatedUbicacion()
    {
        $this->validateOnly('ubicacion');
    }

    public function render()
    {
        return view('livewire.arbitros-form');
    }
}


