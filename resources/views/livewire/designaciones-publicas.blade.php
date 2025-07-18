<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                    Designaciones Arbitrales
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    Consulta las asignaciones oficiales de árbitros para los partidos de fútbol en El Salvador
                </p>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Filtros de Búsqueda</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <!-- Búsqueda general -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Buscar equipos o jornada
                    </label>
                    <input type="text" 
                           wire:model.live="search" 
                           id="search"
                           placeholder="Ej: Alianza, FAS, Jornada 5..."
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Filtro por jornada -->
                <div>
                    <label for="jornada" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Jornada
                    </label>
                    <select wire:model.live="jornadaFilter" 
                            id="jornada"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Todas las jornadas</option>
                        @foreach($jornadas as $jornada)
                            <option value="{{ $jornada->id }}">{{ $jornada->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por división -->
                <div>
                    <label for="division" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        División
                    </label>
                    <select wire:model.live="divisionFilter" 
                            id="division"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Todas las divisiones</option>
                        @foreach($divisiones as $division)
                            <option value="{{ $division }}">{{ $division }} División</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por fecha -->
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Fecha
                    </label>
                    <input type="date" 
                           wire:model.live="fechaFilter" 
                           id="fecha"
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex justify-end">
                <button wire:click="limpiarFiltros" 
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200">
                    Limpiar Filtros
                </button>
            </div>
        </div>

        <!-- Grid de partidos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($partidos as $partido)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Header del partido -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium">{{ $partido->jornada->nombre }}</span>
                            <span class="text-xs bg-white/20 px-2 py-1 rounded-full">
                                {{ $partido->jornada->division }} División
                            </span>
                        </div>
                        
                        <!-- Equipos -->
                        <div class="text-center">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 text-center">
                                    @if($partido->equipoLocal->logo)
                                        <img src="{{ $partido->equipoLocal->logo }}" 
                                             alt="{{ $partido->equipoLocal->nombre }}" 
                                             class="w-12 h-12 mx-auto mb-2 rounded-full bg-white p-1">
                                    @else
                                        <div class="w-12 h-12 mx-auto mb-2 bg-white rounded-full flex items-center justify-center">
                                            <span class="text-blue-600 font-bold text-lg">
                                                {{ substr($partido->equipoLocal->nombre, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    <p class="text-sm font-medium">{{ $partido->equipoLocal->nombre }}</p>
                                </div>
                                
                                <div class="px-4">
                                    <span class="text-2xl font-bold">VS</span>
                                </div>
                                
                                <div class="flex-1 text-center">
                                    @if($partido->equipoVisitante->logo)
                                        <img src="{{ $partido->equipoVisitante->logo }}" 
                                             alt="{{ $partido->equipoVisitante->nombre }}" 
                                             class="w-12 h-12 mx-auto mb-2 rounded-full bg-white p-1">
                                    @else
                                        <div class="w-12 h-12 mx-auto mb-2 bg-white rounded-full flex items-center justify-center">
                                            <span class="text-blue-600 font-bold text-lg">
                                                {{ substr($partido->equipoVisitante->nombre, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    <p class="text-sm font-medium">{{ $partido->equipoVisitante->nombre }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información del partido -->
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-4 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $partido->fecha->format('d/m/Y') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $partido->hora->format('H:i') }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $partido->sede }}
                            </div>
                        </div>

                            <!-- Árbitros asignados -->
                            <div class="border-t dark:border-gray-700 pt-4">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Cuerpo Arbitral</h4>
                                
                                <div class="text-center py-4">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pendiente de asignación
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                            No se encontraron partidos
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">
                            No hay partidos que coincidan con los criterios de búsqueda seleccionados.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if($partidos->hasPages())
            <div class="mt-8">
                {{ $partidos->links() }}
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-300">
                © {{ date('Y') }} Sistema de Árbitros - El Salvador. Información oficial de designaciones arbitrales.
            </p>
        </div>
    </footer>
</div>
