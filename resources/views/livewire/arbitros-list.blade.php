<div class="p-6">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Gestión de Árbitros</h1>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Lista completa de árbitros registrados en el sistema.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            @can('create', App\Models\Arbitro::class)
                <a href="{{ route('arbitros.create') }}" 
                   class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-800 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-offset-2 sm:w-auto">
                    <i class="fas fa-user-plus mr-2"></i>
                    Nuevo Árbitro
                </a>
            @endcan
        </div>
    </div>

    <!-- Filtros y búsqueda -->
    <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Búsqueda -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buscar</label>
                <input type="text" 
                       wire:model.live="search" 
                       id="search"
                       placeholder="Nombre, apellido o email..."
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-800 focus:ring-blue-800 sm:text-sm">
            </div>

            <!-- Filtro por categoría -->
            <div>
                <label for="categoria" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                <select wire:model.live="categoriaFilter" 
                        id="categoria"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-800 focus:ring-blue-800 sm:text-sm">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria }}">{{ $categoria }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por estado -->
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                <select wire:model.live="estadoFilter" 
                        id="estado"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-800 focus:ring-blue-800 sm:text-sm">
                    <option value="">Todos los estados</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado }}">{{ ucfirst($estado) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtro por ubicación -->
            <div>
                <label for="ubicacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                <select wire:model.live="ubicacionFilter" 
                        id="ubicacion"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-800 focus:ring-blue-800 sm:text-sm">
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

    <!-- Tabla de árbitros -->
    <div class="mt-6 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('nombre')">
                                    Nombre
                                    @if($sortField === 'nombre')
                                        @if($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('categoria')">
                                    Categoría
                                    @if($sortField === 'categoria')
                                        @if($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Estado
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('partidos_arbitrados')">
                                    Partidos
                                    @if($sortField === 'partidos_arbitrados')
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
                            @forelse($arbitros as $arbitro)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($arbitro->foto)
                                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $arbitro->foto) }}" alt="{{ $arbitro->nombre_completo }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ substr($arbitro->nombre, 0, 1) }}{{ substr($arbitro->apellido, 0, 1) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $arbitro->nombre_completo }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $arbitro->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($arbitro->categoria === 'FIFA') bg-purple-100 text-purple-800
                                            @elseif($arbitro->categoria === 'Primera') bg-blue-100 text-blue-800
                                            @elseif($arbitro->categoria === 'Segunda') bg-green-100 text-green-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ $arbitro->categoria }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button wire:click="toggleEstado({{ $arbitro->id }})" 
                                                @can('update', $arbitro) @else disabled @endcan
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full cursor-pointer
                                                @if($arbitro->estado === 'disponible') bg-green-100 text-green-800 hover:bg-green-200
                                                @elseif($arbitro->estado === 'ocupado') bg-red-100 text-red-800 hover:bg-red-200
                                                @else bg-gray-100 text-gray-800 hover:bg-gray-200
                                                @endif">
                                            {{ ucfirst($arbitro->estado) }}
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $arbitro->ubicacion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $arbitro->partidos_arbitrados }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('arbitros.show', $arbitro) }}" 
                                               class="text-blue-800 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Ver
                                            </a>
                                            @can('update', $arbitro)
                                                <a href="{{ route('arbitros.edit', $arbitro) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                    Editar
                                                </a>
                                            @endcan
                                            @can('delete', $arbitro)
                                                <button wire:click="confirmDelete({{ $arbitro->id }})" 
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                    Eliminar
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                        No se encontraron árbitros que coincidan con los criterios de búsqueda.
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
        {{ $arbitros->links() }}
    </div>

    <!-- Modal de confirmación de eliminación -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="delete-modal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mt-4">Confirmar eliminación</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500 dark:text-gray-300">
                            ¿Estás seguro de que quieres eliminar al árbitro 
                            <strong class="text-gray-900 dark:text-white">{{ $arbitroToDelete?->nombre_completo }}</strong>?
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                            Esta acción no se puede deshacer.
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <div class="flex space-x-3 justify-center">
                            <button wire:click="cancelDelete" 
                                    class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Cancelar
                            </button>
                            <button wire:click="deleteArbitro" 
                                    class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
