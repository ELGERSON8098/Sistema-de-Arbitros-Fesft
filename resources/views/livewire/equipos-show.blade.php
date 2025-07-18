<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Información del Equipo -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Información del Equipo</h3>
                
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Equipo</label>
                        <p class="text-lg font-semibold">{{ $equipo->nombre }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">División</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($equipo->division === 'Primera') bg-green-100 text-green-800
                            @elseif($equipo->division === 'Segunda') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $equipo->division }} División
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sede (Estadio)</label>
                        <p>{{ $equipo->sede }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                        <p>{{ $equipo->ubicacion }}</p>
                    </div>
                </div>
            </div>

            <!-- Logo del Equipo -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Logo del Equipo</h3>
                
                <div class="flex justify-center">
                    @if($equipo->logo)
                        <img src="{{ Storage::url($equipo->logo) }}" alt="Logo de {{ $equipo->nombre }}" 
                             class="w-32 h-32 object-contain rounded-lg border border-gray-200">
                    @else
                        <div class="w-32 h-32 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Historial de Partidos -->
        <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Historial de Partidos</h3>
            @if ($equipo->partidosLocal->count() > 0 || $equipo->partidosVisitante->count() > 0)
                <div class="space-y-2">
                    @foreach ($equipo->partidosLocal as $partido)
                        <div class="flex justify-between items-center p-2 bg-white dark:bg-gray-800 rounded">
                            <span>{{ $equipo->nombre }} vs {{ $partido->visitante->nombre }}</span>
                            <span class="text-sm text-gray-500">{{ $partido->fecha->format('d/m/Y') }} - Local</span>
                        </div>
                    @endforeach
                    @foreach ($equipo->partidosVisitante as $partido)
                        <div class="flex justify-between items-center p-2 bg-white dark:bg-gray-800 rounded">
                            <span>{{ $partido->local->nombre }} vs {{ $equipo->nombre }}</span>
                            <span class="text-sm text-gray-500">{{ $partido->fecha->format('d/m/Y') }} - Visitante</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-400">No hay partidos registrados para este equipo.</p>
            @endif
        </div>
    </div>
</div>

