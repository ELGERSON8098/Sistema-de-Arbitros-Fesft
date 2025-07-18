<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PartidoController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Partido::class);
        
        return view('partidos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Partido::class);
        
        return view('partidos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Partido::class);
        
        $validated = $request->validate([
            'jornada_id' => 'required|exists:jornadas,id',
            'local_id' => 'required|exists:equipos,id',
            'visitante_id' => 'required|exists:equipos,id|different:local_id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'sede' => 'required|string|max:255',
        ]);

        Partido::create($validated);

        return redirect()->route('partidos.index')
            ->with('message', 'Partido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partido $partido)
    {
        $this->authorize('view', $partido);
        
        return view('partidos.show', compact('partido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partido $partido)
    {
        $this->authorize('update', $partido);
        
        return view('partidos.edit', compact('partido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partido $partido)
    {
        $this->authorize('update', $partido);
        
        $validated = $request->validate([
            'jornada_id' => 'required|exists:jornadas,id',
            'local_id' => 'required|exists:equipos,id',
            'visitante_id' => 'required|exists:equipos,id|different:local_id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'sede' => 'required|string|max:255',
        ]);

        $partido->update($validated);

        return redirect()->route('partidos.index')
            ->with('message', 'Partido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        $this->authorize('delete', $partido);
        
        $partido->delete();

        return redirect()->route('partidos.index')
            ->with('message', 'Partido eliminado exitosamente.');
    }
}

