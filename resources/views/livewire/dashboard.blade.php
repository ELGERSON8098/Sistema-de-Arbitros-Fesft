<div class="space-y-6">
    <!-- Estadísticas Generales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Árbitros -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                Total Árbitros
                            </dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ $estadisticasGenerales['total_arbitros'] ?? 0 }}
                            </dd>
                            <dd class="text-sm text-green-600">
                                {{ $estadisticasGenerales['arbitros_activos'] ?? 0 }} activos
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Árbitros Disponibles -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                Árbitros Disponibles
                            </dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ $estadisticasGenerales['arbitros_disponibles'] ?? 0 }}
                            </dd>
                            <dd class="text-sm text-gray-500">
                                Para asignación
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Equipos -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                Total Equipos
                            </dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ $estadisticasGenerales['total_equipos'] ?? 0 }}
                            </dd>
                            <dd class="text-sm text-gray-500">
                                Registrados
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partidos con Asignaciones -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                Partidos Asignados
                            </dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ $estadisticasGenerales['partidos_con_asignaciones'] ?? 0 }}/{{ $estadisticasGenerales['total_partidos'] ?? 0 }}
                            </dd>
                            <dd class="text-sm text-blue-600">
                                {{ $estadisticasGenerales['porcentaje_asignacion'] ?? 0 }}% completado
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos y Tablas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Árbitros Más Designados -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    Árbitros Más Designados (Últimos 3 meses)
                </h3>
            </div>
            <div class="p-6">
                @if(count($arbitrosMasDesignados) > 0)
                    <div class="space-y-4">
                        @foreach($arbitrosMasDesignados as $index => $arbitro)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                            {{ $index + 1 }}
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $arbitro['nombre'] }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $arbitro['categoria'] }}
                                        </p>
                                    </div>
                                </div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $arbitro['asignaciones'] }} partidos
                                    </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            No hay datos de asignaciones recientes
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Árbitros por Categoría -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    Árbitros por Categoría
                </h3>
            </div>
            <div class="p-6">
                    @if(count($arbitrosPorCategoria) > 0)
                        <div class="space-y-4">
                            @foreach($arbitrosPorCategoria as $categoria)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between items-center">
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $categoria['categoria'] }}
                                        </h4>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $categoria['total'] }} árbitros
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            No hay árbitros registrados
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Asignaciones por División -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                Asignaciones por División
            </h3>
        </div>
        <div class="p-6">
            @if(count($asignacionesPorDivision) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        División
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Equipos
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Partidos
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Asignados
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Estado
                                    </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($asignacionesPorDivision as $division)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $division['division'] }} División
                                    </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $division['equipos'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            0
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            0%
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                <div class="bg-green-600 h-2 rounded-full" style="width: 0%"></div>
                                            </div>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        No hay datos de divisiones disponibles
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Botón de actualización -->
    <div class="flex justify-end">
        <button wire:click="cargarEstadisticas" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Actualizar Estadísticas
        </button>
    </div>
</div>
