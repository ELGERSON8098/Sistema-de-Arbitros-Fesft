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
                                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Ver
                                            </a>
                                            @can('update', $equipo)
                                                <a href="{{ route('equipos.edit', $equipo) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                    Editar
                                                </a>
                                            @endcan
                                            @can('delete', $equipo)
                                                <button wire:click="deleteEquipo({{ $equipo->id }})" 
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este equipo?')"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
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
</div>
