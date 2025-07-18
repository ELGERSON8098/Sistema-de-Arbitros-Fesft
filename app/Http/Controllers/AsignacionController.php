<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\AsignacionArbitral;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AsignacionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show the form for creating a new resource.
     */
    public function create(Partido $partido)
    {
        $this->authorize('create', AsignacionArbitral::class);
        
        return view('asignaciones.create', compact('partido'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Partido $partido)
    {
        $this->authorize('create', AsignacionArbitral::class);
        
        // La lógica de almacenamiento se maneja en el componente Livewire
        return redirect()->route('partidos.show', $partido);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partido $partido)
    {
        $this->authorize('update', AsignacionArbitral::class);
        
        return view('asignaciones.create', compact('partido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partido $partido)
    {
        $this->authorize('update', AsignacionArbitral::class);
        
        // La lógica de actualización se maneja en el componente Livewire
        return redirect()->route('partidos.show', $partido);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        $this->authorize('delete', AsignacionArbitral::class);
        
        if ($partido->grupo_arbitral_id) {
            AsignacionArbitral::where('grupo_arbitral_id', $partido->grupo_arbitral_id)->delete();
            $partido->update(['grupo_arbitral_id' => null]);
        }
        
        return redirect()->route('partidos.show', $partido)
                        ->with('message', 'Asignaciones eliminadas exitosamente.');
    }
}

