<div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <!-- Información del Partido -->
            <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Información del Partido</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <strong>Enfrentamiento:</strong><br>
                        {{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}
                    </div>
                    <div>
                        <strong>Fecha y Hora:</strong><br>
                        {{ $partido->fecha->format('d/m/Y') }} - {{ $partido->hora }}
                    </div>
                    <div>
                        <strong>Sede:</strong><br>
                        {{ $partido->sede }}
                    </div>
                </div>
            </div>

            <!-- Errores -->
            @if(!empty($errores))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach($errores as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Botones de Acción -->
            <div class="mb-6 flex flex-wrap gap-2">
                <button wire:click="generarSugerencias" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Generar Sugerencias
                </button>
                
                @if($mostrarSugerencias && !empty($sugerencias))
                    <button wire:click="aplicarTodasLasSugerencias" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Aplicar Todas las Sugerencias
                    </button>
                @endif
                
                <button wire:click="limpiarAsignaciones" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Limpiar Todo
                </button>
            </div>

            <!-- Formulario de Asignación -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Árbitro Principal -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Árbitro Principal *
                        </label>
                        <select wire:model="arbitroPrincipal" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Seleccionar árbitro principal</option>
                            @foreach($arbitrosDisponibles as $arbitro)
                                <option value="{{ $arbitro->id }}">{{ $arbitro->nombre }} {{ $arbitro->apellido }} ({{ $arbitro->categoria }})</option>
                            @endforeach
                        </select>
                        @if($mostrarSugerencias && isset($sugerencias['arbitro_principal']))
                            <div class="mt-2 p-2 bg-blue-50 rounded">
                                <span class="text-sm text-blue-700">
                                    Sugerencia: {{ $sugerencias['arbitro_principal']->nombre }} {{ $sugerencias['arbitro_principal']->apellido }}
                                </span>
                                <button wire:click="aplicarSugerencia('arbitro_principal')" class="ml-2 text-xs bg-blue-500 text-white px-2 py-1 rounded">
                                    Aplicar
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Asistente 1 -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Asistente 1
                        </label>
                        <select wire:model="asistente1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Seleccionar asistente 1</option>
                            @foreach($arbitrosDisponibles as $arbitro)
                                <option value="{{ $arbitro->id }}">{{ $arbitro->nombre }} {{ $arbitro->apellido }} ({{ $arbitro->categoria }})</option>
                            @endforeach
                        </select>
                        @if($mostrarSugerencias && isset($sugerencias['asistente_1']))
                            <div class="mt-2 p-2 bg-blue-50 rounded">
                                <span class="text-sm text-blue-700">
                                    Sugerencia: {{ $sugerencias['asistente_1']->nombre }} {{ $sugerencias['asistente_1']->apellido }}
                                </span>
                                <button wire:click="aplicarSugerencia('asistente_1')" class="ml-2 text-xs bg-blue-500 text-white px-2 py-1 rounded">
                                    Aplicar
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Asistente 2 -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Asistente 2
                        </label>
                        <select wire:model="asistente2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Seleccionar asistente 2</option>
                            @foreach($arbitrosDisponibles as $arbitro)
                                <option value="{{ $arbitro->id }}">{{ $arbitro->nombre }} {{ $arbitro->apellido }} ({{ $arbitro->categoria }})</option>
                            @endforeach
                        </select>
                        @if($mostrarSugerencias && isset($sugerencias['asistente_2']))
                            <div class="mt-2 p-2 bg-blue-50 rounded">
                                <span class="text-sm text-blue-700">
                                    Sugerencia: {{ $sugerencias['asistente_2']->nombre }} {{ $sugerencias['asistente_2']->apellido }}
                                </span>
                                <button wire:click="aplicarSugerencia('asistente_2')" class="ml-2 text-xs bg-blue-500 text-white px-2 py-1 rounded">
                                    Aplicar
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Cuarto Árbitro -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Cuarto Árbitro
                        </label>
                        <select wire:model="cuartoArbitro" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Seleccionar cuarto árbitro</option>
                            @foreach($arbitrosDisponibles as $arbitro)
                                <option value="{{ $arbitro->id }}">{{ $arbitro->nombre }} {{ $arbitro->apellido }} ({{ $arbitro->categoria }})</option>
                            @endforeach
                        </select>
                        @if($mostrarSugerencias && isset($sugerencias['cuarto_arbitro']))
                            <div class="mt-2 p-2 bg-blue-50 rounded">
                                <span class="text-sm text-blue-700">
                                    Sugerencia: {{ $sugerencias['cuarto_arbitro']->nombre }} {{ $sugerencias['cuarto_arbitro']->apellido }}
                                </span>
                                <button wire:click="aplicarSugerencia('cuarto_arbitro')" class="ml-2 text-xs bg-blue-500 text-white px-2 py-1 rounded">
                                    Aplicar
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- VAR -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            VAR (Video Assistant Referee)
                        </label>
                        <select wire:model="var" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Seleccionar VAR</option>
                            @foreach($arbitrosDisponibles->where('categoria', 'FIFA') as $arbitro)
                                <option value="{{ $arbitro->id }}">{{ $arbitro->nombre }} {{ $arbitro->apellido }} ({{ $arbitro->categoria }})</option>
                            @endforeach
                        </select>
                        @if($mostrarSugerencias && isset($sugerencias['var']))
                            <div class="mt-2 p-2 bg-blue-50 rounded">
                                <span class="text-sm text-blue-700">
                                    Sugerencia: {{ $sugerencias['var']->nombre }} {{ $sugerencias['var']->apellido }}
                                </span>
                                <button wire:click="aplicarSugerencia('var')" class="ml-2 text-xs bg-blue-500 text-white px-2 py-1 rounded">
                                    Aplicar
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Botón Guardar -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('partidos.show', $partido) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancelar
                </a>
                <button wire:click="guardarAsignaciones" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Guardar Asignaciones
                </button>
            </div>
        </div>
    </div>
</div>

