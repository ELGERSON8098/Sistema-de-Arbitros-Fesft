<div class="p-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Gestión de Equipos</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Lista completa de equipos registrados en el sistema.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-2">
                @can('create', App\Models\Equipo::class)
                    <a href="{{ route('equipos.create') }}"
                       class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Nuevo Equipo
                    </a>
                @endcan
        </div>
    </div>

    <!-- Filtros y búsqueda -->
    <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Búsqueda -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buscar</label>
                <input type="text" 
                       wire:model.live="search" 
                       id="search"
                       placeholder="Nombre, sede o ubicación..."
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Filtro por división -->
            <div>
                <label for="division" class="block text-sm font-medium text-gray-700 dark:text-gray-300">División</label>
                <select wire:model.live="divisionFilter" 
                        id="division"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Todas las divisiones</option>
                    @foreach($divisiones as $division)
                        <option value="{{ $division }}">{{ $division }} División</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por ubicación -->
            <div>
                <label for="ubicacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                <select wire:model.live="ubicacionFilter" 
                        id="ubicacion"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Todas las ubicaciones</option>
                    @foreach($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion }}">{{ $ubicacion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Mensajes de estado -->
    @if (session()->has('message'))
        <div class="mt-4 rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Tabla de equipos -->
    <div class="mt-6 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('nombre')">
                                    Equipo
                                    @if($sortField === 'nombre')
                                        @if($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('division')">
                                    División
                                    @if($sortField === 'division')
                                        @if($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('sede')">
                                    Sede
                                    @if($sortField === 'sede')
                                        @if($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('ubicacion')">
                                    Ubicación
                                    @if($sortField === 'ubicacion')
                                        @if($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse($equipos as $equipo)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($equipo->logo)
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $equipo->logo) }}" alt="{{ $equipo->nombre }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ substr($equipo->nombre, 0, 2) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipo->nombre }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $equipo->division }} División</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($equipo->division === 'Primera') bg-blue-100 text-blue-800
                                            @elseif($equipo->division === 'Segunda') bg-green-100 text-green-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ $equipo->division }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $equipo->sede }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $equipo->ubicacion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('equipos.show', $equipo) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition duration-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 px-2 py-1 rounded">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Ver
                                            </a>
                                            @can('update', $equipo)
                                                <a href="{{ route('equipos.edit', $equipo) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 transition duration-200 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 px-2 py-1 rounded">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Editar
                                                </a>
                                            @endcan
                                            @can('delete', $equipo)
                                                <button onclick="eliminarEquipoConfirm({{ $equipo->id }}, '{{ $equipo->nombre }}')"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition duration-200 hover:bg-red-50 dark:hover:bg-red-900/20 px-2 py-1 rounded">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                        No se encontraron equipos que coincidan con los criterios de búsqueda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $equipos->links() }}
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div id="modal-eliminar" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Overlay con blur -->
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-all duration-300 opacity-0" aria-hidden="true" id="modal-overlay"></div>
            
            <!-- Espaciador para centrar el modal -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <!-- Contenedor del Modal -->
            <div id="modal-content" class="relative inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all duration-300 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-8 scale-95 opacity-0">
                
                <!-- Botón de cerrar (X) -->
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" onclick="cerrarModal()" class="bg-white dark:bg-gray-800 rounded-full p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <span class="sr-only">Cerrar</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Contenido del Modal -->
                <div class="sm:flex sm:items-start">
                    <!-- Icono de advertencia -->
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 sm:mx-0 sm:h-12 sm:w-12 shadow-lg">
                        <svg class="h-8 w-8 sm:h-6 sm:w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    
                    <!-- Texto del Modal -->
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" id="modal-title">
                            ¿Eliminar Equipo?
                        </h3>
                        <div class="mt-3">
                            <p class="text-base text-gray-600 dark:text-gray-300 leading-relaxed" id="mensaje-eliminacion">
                                ¿Estás seguro de que deseas eliminar este equipo?
                            </p>
                            <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border-l-4 border-red-400">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                            ⚠️ Esta acción no se puede deshacer
                                        </p>
                                        <p class="text-xs text-red-700 dark:text-red-300 mt-1">
                                            Se eliminarán todos los datos asociados al equipo
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botones de Acción -->
                <div class="mt-8 sm:mt-6 sm:flex sm:flex-row-reverse sm:gap-3">
                    <button id="btn-confirmar" onclick="confirmarEliminacion()" type="button" 
                            class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-lg px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-base font-semibold text-white hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200 transform hover:scale-105 hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Sí, Eliminar
                    </button>
                    <button id="btn-cancelar" onclick="cerrarModal()" type="button" 
                            class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
@keyframes progress {
    0% { width: 0%; }
    50% { width: 100%; }
    100% { width: 0%; }
}

@keyframes fadeInScale {
    0% {
        opacity: 0;
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes slideInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-enter {
    animation: fadeInScale 0.3s ease-out;
}

.modal-content-enter {
    animation: slideInUp 0.4s ease-out;
}

/* Mejoras para el backdrop blur */
.backdrop-blur-sm {
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}

/* Overlay mejorado */
#modal-overlay {
    background: rgba(17, 24, 39, 0.6);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    transition: opacity 0.3s ease-in-out;
}

/* Asegurar que el overlay no interfiera con el contenido */
#modal-overlay.opacity-0 {
    opacity: 0;
    pointer-events: none;
}

#modal-overlay.opacity-100 {
    opacity: 1;
    pointer-events: auto;
}

/* Transición suave para el modal */
#modal-eliminar {
    transition: all 0.3s ease-in-out;
}

#modal-content {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Efectos hover mejorados para botones */
.btn-hover-scale:hover {
    transform: scale(1.05);
}

.btn-hover-glow:hover {
    box-shadow: 0 0 20px rgba(239, 68, 68, 0.4);
}
</style>
@endpush

@push('scripts')
<script>
let equipoIdAEliminar = null;
let nombreEquipoAEliminar = '';

function eliminarEquipoConfirm(equipoId, nombreEquipo) {
    equipoIdAEliminar = equipoId;
    nombreEquipoAEliminar = nombreEquipo;
    
    // Actualizar el mensaje del modal
    document.getElementById('mensaje-eliminacion').innerHTML = 
        `¿Estás seguro de que deseas eliminar el equipo <strong class="text-gray-900 dark:text-white font-semibold">"${nombreEquipo}"</strong>?`;
    
    // Mostrar el modal
    const modal = document.getElementById('modal-eliminar');
    const modalContent = document.getElementById('modal-content');
    const overlay = document.getElementById('modal-overlay');
    
    // Mostrar modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevenir scroll del body
    
    // Animar entrada con efecto más suave
    setTimeout(() => {
        overlay.classList.remove('opacity-0');
        overlay.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    // Enfocar el botón cancelar por defecto
    setTimeout(() => {
        document.getElementById('btn-cancelar').focus();
    }, 150);
}

function cerrarModal() {
    const modal = document.getElementById('modal-eliminar');
    const modalContent = document.getElementById('modal-content');
    const overlay = document.getElementById('modal-overlay');
    
    // Animar salida
    overlay.classList.remove('opacity-100');
    overlay.classList.add('opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    // Ocultar modal después de la animación
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = ''; // Restaurar scroll del body
        equipoIdAEliminar = null;
        nombreEquipoAEliminar = '';
        
        // Restaurar contenido original del modal
        restaurarModalOriginal();
    }, 300);
}

function restaurarModalOriginal() {
    const modalContent = document.getElementById('modal-content');
    modalContent.innerHTML = `
        <!-- Botón de cerrar (X) -->
        <div class="absolute top-0 right-0 pt-4 pr-4">
            <button type="button" onclick="cerrarModal()" class="bg-white dark:bg-gray-800 rounded-full p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                <span class="sr-only">Cerrar</span>
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Contenido del Modal -->
        <div class="sm:flex sm:items-start">
            <!-- Icono de advertencia -->
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 sm:mx-0 sm:h-12 sm:w-12 shadow-lg">
                <svg class="h-8 w-8 sm:h-6 sm:w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>
            
            <!-- Texto del Modal -->
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" id="modal-title">
                    ¿Eliminar Equipo?
                </h3>
                <div class="mt-3">
                    <p class="text-base text-gray-600 dark:text-gray-300 leading-relaxed" id="mensaje-eliminacion">
                        ¿Estás seguro de que deseas eliminar este equipo?
                    </p>
                    <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border-l-4 border-red-400">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                    ⚠️ Esta acción no se puede deshacer
                                </p>
                                <p class="text-xs text-red-700 dark:text-red-300 mt-1">
                                    Se eliminarán todos los datos asociados al equipo
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Botones de Acción -->
        <div class="mt-8 sm:mt-6 sm:flex sm:flex-row-reverse sm:gap-3">
            <button id="btn-confirmar" onclick="confirmarEliminacion()" type="button" 
                    class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-lg px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-base font-semibold text-white hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200 transform hover:scale-105 hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Sí, Eliminar
            </button>
            <button id="btn-cancelar" onclick="cerrarModal()" type="button" 
                    class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition-all duration-200 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Cancelar
            </button>
        </div>
    `;
}

function confirmarEliminacion() {
    if (!equipoIdAEliminar) return;
    
    // Cambiar el contenido del modal a estado de carga
    const modalContent = document.getElementById('modal-content');
    modalContent.innerHTML = `
        <div class="text-center py-8">
            <!-- Spinner de carga elegante -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-blue-100 to-indigo-200 dark:from-blue-900/30 dark:to-indigo-800/30 shadow-lg mb-6">
                <svg class="animate-spin h-10 w-10 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Eliminando Equipo...</h3>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-2">
                Procesando eliminación de <strong class="text-gray-900 dark:text-white">"${nombreEquipoAEliminar}"</strong>
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Por favor espera un momento...
            </p>
            
            <!-- Barra de progreso animada -->
            <div class="mt-6 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full animate-pulse" style="width: 100%; animation: progress 2s ease-in-out infinite;"></div>
            </div>
        </div>
    `;
    
    // Llamar a Livewire para eliminar
    @this.call('deleteEquipo', equipoIdAEliminar).then(() => {
        // Mostrar mensaje de éxito
        modalContent.innerHTML = `
            <div class="text-center py-8">
                <!-- Icono de éxito con animación -->
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-green-100 to-emerald-200 dark:from-green-900/30 dark:to-emerald-800/30 shadow-lg mb-6 animate-bounce">
                    <svg class="h-10 w-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">¡Equipo Eliminado!</h3>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-2">
                    El equipo <strong class="text-gray-900 dark:text-white">"${nombreEquipoAEliminar}"</strong> ha sido eliminado exitosamente.
                </p>
                
                <!-- Mensaje de confirmación con estilo -->
                <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                    <div class="flex items-center justify-center">
                        <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            Operación completada con éxito
                        </p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <button onclick="cerrarModal()" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-700 text-white text-base font-semibold rounded-xl shadow-lg hover:from-green-700 hover:to-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Perfecto
                    </button>
                </div>
            </div>
        `;
        
        // Cerrar automáticamente después de 3 segundos
        setTimeout(() => {
            cerrarModal();
        }, 3000);
        
    }).catch((error) => {
        console.error('Error al eliminar:', error);
        
        // Mostrar mensaje de error
        modalContent.innerHTML = `
            <div class="text-center py-8">
                <!-- Icono de error -->
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-red-100 to-rose-200 dark:from-red-900/30 dark:to-rose-800/30 shadow-lg mb-6">
                    <svg class="h-10 w-10 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Error al Eliminar</h3>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-2">
                    No se pudo eliminar el equipo <strong class="text-gray-900 dark:text-white">"${nombreEquipoAEliminar}"</strong>
                </p>
                
                <!-- Mensaje de error con estilo -->
                <div class="mt-6 p-4 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800">
                    <div class="flex items-center justify-center">
                        <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">
                            Por favor intenta de nuevo o contacta al administrador
                        </p>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-center space-x-4">
                    <button onclick="cerrarModal()" 
                            class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 shadow-sm text-base font-medium rounded-xl text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cerrar
                    </button>
                    <button onclick="confirmarEliminacion()" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-rose-700 text-white text-base font-semibold rounded-xl shadow-lg hover:from-red-700 hover:to-rose-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reintentar
                    </button>
                </div>
            </div>
        `;
    });
}

// Cerrar modal con ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('modal-eliminar').classList.contains('hidden')) {
        cerrarModal();
    }
});

// Cerrar modal al hacer clic fuera
document.getElementById('modal-eliminar').addEventListener('click', function(e) {
    if (e.target === this || e.target.id === 'modal-overlay') {
        cerrarModal();
    }
});

// Mejorar la experiencia visual de los botones
document.addEventListener('DOMContentLoaded', function() {
    // Agregar efectos hover mejorados a todos los botones de acción
    const actionButtons = document.querySelectorAll('a[href*="equipos"], button[onclick*="eliminar"]');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-1px)';
        });
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
