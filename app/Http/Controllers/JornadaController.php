<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JornadaController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Jornada::class);
        
        return view('jornadas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Jornada::class);
        
        return view('jornadas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Jornada::class);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'temporada' => 'required|string|max:255',
            'division' => 'required|in:Primera,Segunda,Tercera',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        Jornada::create($validated);

        return redirect()->route('jornadas.index')
            ->with('message', 'Jornada creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jornada $jornada)
    {
        $this->authorize('view', $jornada);
        
        return view('jornadas.show', compact('jornada'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jornada $jornada)
    {
        $this->authorize('update', $jornada);
        
        return view('jornadas.edit', compact('jornada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jornada $jornada)
    {
        $this->authorize('update', $jornada);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'temporada' => 'required|string|max:255',
            'division' => 'required|in:Primera,Segunda,Tercera',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $jornada->update($validated);

        return redirect()->route('jornadas.index')
            ->with('message', 'Jornada actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jornada $jornada)
    {
        $this->authorize('delete', $jornada);
        
        $jornada->delete();

        return redirect()->route('jornadas.index')
            ->with('message', 'Jornada eliminada exitosamente.');
    }
}

