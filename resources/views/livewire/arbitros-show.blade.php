<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="flex items-center space-x-4">
            @if ($arbitro->foto)
                <img src="{{ Storage::url($arbitro->foto) }}" alt="Foto de {{ $arbitro->nombre }}" class="w-24 h-24 rounded-full object-cover">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-4xl font-bold">
                    {{ substr($arbitro->nombre, 0, 1) }}{{ substr($arbitro->apellido, 0, 1) }}
                </div>
            @endif
            <div>
                <h3 class="text-2xl font-bold">{{ $arbitro->nombre }} {{ $arbitro->apellido }}</h3>
                <p class="text-gray-600 dark:text-gray-400">Categoría: <span class="font-semibold">{{ $arbitro->categoria }}</span></p>
                <p class="text-gray-600 dark:text-gray-400">Estado: <span class="font-semibold">{{ $arbitro->estado }}</span></p>
                <p class="text-gray-600 dark:text-gray-400">Ubicación: <span class="font-semibold">{{ $arbitro->ubicacion }}</span></p>
            </div>
        </div>

        <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
            <h4 class="text-xl font-semibold mb-4">Detalles de Contacto</h4>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $arbitro->email ?? 'N/A' }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Teléfono</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $arbitro->telefono ?? 'N/A' }}</dd>
                </div>
            </dl>
        </div>

        <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
            <h4 class="text-xl font-semibold mb-4">Historial de Partidos Arbitrados</h4>
            @if ($arbitro->partidos->count() > 0)
                <ul class="list-disc list-inside">
                    @foreach ($arbitro->partidos as $partido)
                        <li>{{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }} ({{ $partido->fecha->format('d/m/Y') }}) - Rol: {{ $partido->pivot->rol }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600 dark:text-gray-400">No hay partidos registrados para este árbitro.</p>
            @endif
        </div>
    </div>
</div>


