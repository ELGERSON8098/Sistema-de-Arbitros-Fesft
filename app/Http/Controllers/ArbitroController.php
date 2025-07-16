<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ArbitroController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Arbitro::class);
        
        return view('arbitros.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Arbitro::class);
        
        return view('arbitros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Arbitro::class);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'categoria' => 'required|string|in:FIFA,Primera,Segunda,Tercera',
            'estado' => 'required|string|in:Disponible,Ocupado,Inactivo',
            'ubicacion' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos_arbitros', 'public');
        }

        Arbitro::create($validated);
        
        return redirect()->route('arbitros.index')
                        ->with('message', 'Árbitro creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Arbitro $arbitro)
    {
        $this->authorize('view', $arbitro);
        
        return view('arbitros.show', compact('arbitro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arbitro $arbitro)
    {
        $this->authorize('update', $arbitro);
        
        return view('arbitros.edit', compact('arbitro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Arbitro $arbitro)
    {
        $this->authorize('update', $arbitro);
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'categoria' => 'required|string|in:FIFA,Primera,Segunda,Tercera',
            'estado' => 'required|string|in:Disponible,Ocupado,Inactivo',
            'ubicacion' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($arbitro->foto) {
                Storage::disk('public')->delete($arbitro->foto);
            }
            $validated['foto'] = $request->file('foto')->store('fotos_arbitros', 'public');
        }

        $arbitro->update($validated);
        
        return redirect()->route('arbitros.index')
                        ->with('message', 'Árbitro actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arbitro $arbitro)
    {
        $this->authorize('delete', $arbitro);
        
        // Eliminar foto si existe
        if ($arbitro->foto) {
            Storage::disk('public')->delete($arbitro->foto);
        }
        
        $arbitro->delete();
        
        return redirect()->route('arbitros.index')
                        ->with('message', 'Árbitro eliminado exitosamente.');
    }
}

