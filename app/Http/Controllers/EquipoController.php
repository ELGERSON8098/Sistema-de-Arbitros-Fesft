<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class EquipoController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Equipo::class);
        
        return view('equipos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Equipo::class);
        
        return view('equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Equipo::class);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'division' => 'required|string|in:Primera,Segunda,Tercera',
            'sede' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'logo' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos_equipos', 'public');
        }

        Equipo::create($validated);
        
        return redirect()->route('equipos.index')
                        ->with('message', 'Equipo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        $this->authorize('view', $equipo);
        
        return view('equipos.show', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        $this->authorize('update', $equipo);
        
        return view('equipos.edit', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        $this->authorize('update', $equipo);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'division' => 'required|string|in:Primera,Segunda,Tercera',
            'sede' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'logo' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe
            if ($equipo->logo) {
                Storage::disk('public')->delete($equipo->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logos_equipos', 'public');
        }

        $equipo->update($validated);
        
        return redirect()->route('equipos.index')
                        ->with('message', 'Equipo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        $this->authorize('delete', $equipo);
        
        // Eliminar logo si existe
        if ($equipo->logo) {
            Storage::disk('public')->delete($equipo->logo);
        }
        
        $equipo->delete();
        
        return redirect()->route('equipos.index')
                        ->with('message', 'Equipo eliminado exitosamente.');
    }

    /**
     * Show the form for importing teams from CSV.
     */
    public function import()
    {
        $this->authorize('create', Equipo::class);
        
        return view('equipos.import');
    }
}

