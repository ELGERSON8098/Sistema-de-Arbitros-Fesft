<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __("Detalles del Partido") }}
            </h2>
            <div class="flex space-x-2">
                @can("update", $partido)
                    <a href="{{ route("partidos.edit", $partido) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>
                @endcan
                <a href="{{ route("partidos.index") }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Información del Partido -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Información del Partido</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Enfrentamiento</label>
                                    <p class="text-lg font-semibold">{{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jornada</label>
                                    <p>{{ $partido->jornada->nombre }} - {{ $partido->jornada->division }} División</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha y Hora</label>
                                    <p>{{ $partido->fecha->format('d/m/Y') }} a las {{ $partido->hora }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sede</label>
                                    <p>{{ $partido->sede }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Asignación Arbitral -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Asignación Arbitral</h3>
                            
                            @if($partido->grupo_arbitral_id)
                                <div class="space-y-2">
                                    @foreach($partido->grupoArbitral->asignaciones as $asignacion)
                                        <div class="flex justify-between items-center p-2 bg-white dark:bg-gray-800 rounded">
                                            <span>{{ $asignacion->arbitro->nombre }} {{ $asignacion->arbitro->apellido }}</span>
                                            <span class="text-sm text-gray-500">{{ $asignacion->rol }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-gray-500 dark:text-gray-400 mb-4">No hay árbitros asignados</p>
                                    @can("update", $partido)
                                        <a href="{{ route("asignaciones.create", $partido) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Asignar Árbitros
                                        </a>
                                    @endcan
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

