<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                {{ $equipoId ? 'Editar Equipo' : 'Nuevo Equipo' }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ $equipoId ? 'Modifica la información del equipo seleccionado' : 'Completa la información para registrar un nuevo equipo' }}
            </p>
        </div>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Información Básica -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg form-section">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Información Básica
                </h3>
            </div>
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Equipo -->
                    <div class="md:col-span-2">
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <svg class="w-4 h-4 inline mr-1 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Nombre del Equipo
                        </label>
                        <input type="text" wire:model="nombre" id="nombre" 
                               placeholder="Ej: Club Deportivo Águila"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-200">
                        @error('nombre') 
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- División -->
                    <div>
                        <label for="division" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <svg class="w-4 h-4 inline mr-1 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            División
                        </label>
                        <select wire:model="division" id="division" 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-200">
                            <option value="">Seleccione una división</option>
                            <option value="Primera">Primera División</option>
                            <option value="Segunda">Segunda División</option>
                            <option value="Tercera">Tercera División</option>
                        </select>
                        @error('division') 
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Sede (Estadio) -->
                    <div class="md:col-span-2">
                        <label for="sede" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <svg class="w-4 h-4 inline mr-1 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Sede (Estadio)
                        </label>
                        <input type="text" wire:model="sede" id="sede" 
                               placeholder="Ej: Estadio Juan Francisco Barraza"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-200">
                        @error('sede') 
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Ubicación Geográfica -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg form-section">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Ubicación Geográfica
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Selecciona la ubicación exacta del estadio en el mapa
                </p>
            </div>
            <div class="px-6 py-6">
                <!-- Campos de coordenadas (ocultos) -->
                <input type="hidden" wire:model="latitud" id="latitud">
                <input type="hidden" wire:model="longitud" id="longitud">
                
                <!-- Campo de búsqueda -->
                <div class="mb-6">
                    <label for="search-location" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <svg class="w-4 h-4 inline mr-1 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Buscar ubicación
                    </label>
                    <div class="flex rounded-lg shadow-sm">
                        <input type="text" id="search-location" 
                               placeholder="Ej: Estadio Cuscatlán, San Salvador"
                               class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-l-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-200">
                        <button type="button" onclick="searchLocation(document.getElementById('search-location').value)"
                                class="inline-flex items-center px-6 py-3 border border-l-0 border-gray-300 dark:border-gray-600 rounded-r-lg bg-indigo-50 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-800 transition duration-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Campo de dirección -->
                <div class="mb-6">
                    <label for="ubicacion" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <svg class="w-4 h-4 inline mr-1 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Dirección seleccionada
                    </label>
                    <input type="text" wire:model="ubicacion" id="ubicacion" 
                           placeholder="La dirección se actualizará automáticamente al seleccionar en el mapa"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-600 text-gray-700 dark:text-gray-300 cursor-not-allowed"
                           readonly>
                    @error('ubicacion') 
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!-- Mapa -->
                <div class="border-2 border-gray-200 dark:border-gray-600 rounded-xl overflow-hidden shadow-lg">
                    <div id="map" style="height: 450px; width: 100%;"></div>
                </div>
                
                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300">Instrucciones</h4>
                            <ul class="mt-1 text-sm text-blue-700 dark:text-blue-400 space-y-1">
                                <li>• Usa el campo de búsqueda para encontrar ubicaciones específicas</li>
                                <li>• Haz clic en el mapa para seleccionar la ubicación exacta del estadio</li>
                                <li>• La dirección se actualizará automáticamente</li>
                                <li>• Puedes hacer zoom y navegar por el mapa libremente</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo del Equipo -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg form-section">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Logo del Equipo
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Sube el logo oficial del equipo (opcional)
                </p>
            </div>
            <div class="px-6 py-6">
                <div class="flex items-center space-x-6">
                    <!-- Preview del logo -->
                    <div class="flex-shrink-0">
                        @if ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                        @elseif ($currentLogo)
                            <img src="{{ Storage::url($currentLogo) }}" class="h-24 w-24 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                        @else
                            <div class="h-24 w-24 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center bg-gray-50 dark:bg-gray-700">
                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Input de archivo -->
                    <div class="flex-1">
                        <label for="logo" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Seleccionar archivo
                        </label>
                        <input type="file" wire:model="logo" id="logo" accept="image/*"
                               class="block w-full text-sm text-gray-500 dark:text-gray-400
                                      file:mr-4 file:py-3 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-indigo-50 file:text-indigo-700
                                      hover:file:bg-indigo-100
                                      dark:file:bg-indigo-900 dark:file:text-indigo-300
                                      dark:hover:file:bg-indigo-800
                                      cursor-pointer border border-gray-300 dark:border-gray-600 rounded-lg
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                      transition duration-200">
                        @error('logo') 
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            PNG, JPG o JPEG. Máximo 1MB.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <div class="px-6 py-4 flex items-center justify-between">
                <a href="{{ route('equipos.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Cancelar
                </a>
                
                <button type="submit" 
                        class="inline-flex items-center px-8 py-3 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ $equipoId ? 'Actualizar Equipo' : 'Crear Equipo' }}
                </button>
            </div>
        </div>
    </form>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
<style>
    /* Estilos personalizados para el formulario */
    .form-section {
        transition: all 0.3s ease;
    }
    
    .form-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Animaciones para los inputs */
    input:focus, select:focus {
        transform: scale(1.02);
        transition: all 0.2s ease;
    }
    
    /* Estilos para el mapa */
    .leaflet-container {
        border-radius: 12px;
        font-family: inherit;
    }
    
    .leaflet-popup-content-wrapper {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .leaflet-popup-content {
        margin: 12px 16px;
        line-height: 1.4;
    }
    
    /* Efectos de hover para botones */
    button:hover {
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    
    /* Gradiente sutil para el fondo */
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    /* Animación de carga */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    .loading {
        animation: pulse 2s infinite;
    }
    
    /* Mejoras para el modo oscuro */
    @media (prefers-color-scheme: dark) {
        .leaflet-container {
            filter: brightness(0.9) contrast(1.1);
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Coordenadas por defecto (centro de El Salvador)
    let defaultLat = {{ $latitud ?? '13.6929' }};
    let defaultLng = {{ $longitud ?? '-89.2182' }};
    
    // Inicializar el mapa con un pequeño delay para asegurar que el DOM esté listo
    setTimeout(function() {
        // Verificar que el contenedor del mapa existe
        if (!document.getElementById('map')) {
            console.error('Contenedor del mapa no encontrado');
            return;
        }
        
        // Inicializar el mapa con configuración básica
        let map = L.map('map').setView([defaultLat, defaultLng], {{ $latitud && $longitud ? '15' : '8' }});
        
        // Agregar capa de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);
        
        // Marcador para la ubicación seleccionada
        let marker = null;
        
        // Si ya hay coordenadas, mostrar el marcador
        @if($latitud && $longitud)
            marker = L.marker([{{ $latitud }}, {{ $longitud }}]).addTo(map);
            marker.bindPopup('<strong>Ubicación actual</strong><br><small>{{ $ubicacion ?? "Ubicación guardada" }}</small>').openPopup();
        @endif
    
        // Función para obtener la dirección desde las coordenadas
        async function getAddressFromCoordinates(lat, lng) {
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1&accept-language=es`);
                const data = await response.json();
                
                if (data && data.display_name) {
                    return data.display_name;
                }
                return `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            } catch (error) {
                console.error('Error al obtener la dirección:', error);
                return `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            }
        }
        
        // Manejar clic en el mapa
        map.on('click', async function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            
            // Remover marcador anterior si existe
            if (marker) {
                map.removeLayer(marker);
            }
            
            // Agregar nuevo marcador (usando el marcador por defecto de Leaflet)
            marker = L.marker([lat, lng]).addTo(map);
            
            // Mostrar indicador de carga en el popup
            marker.bindPopup('<div style="text-align: center; padding: 10px;"><strong>🔄 Obteniendo dirección...</strong></div>').openPopup();
            
            try {
                // Obtener la dirección
                const address = await getAddressFromCoordinates(lat, lng);
                
                // Actualizar los campos del formulario sin usar Livewire directamente
                document.getElementById('latitud').value = lat;
                document.getElementById('longitud').value = lng;
                document.getElementById('ubicacion').value = address;
                
                // Disparar eventos de input para que Livewire detecte los cambios
                document.getElementById('latitud').dispatchEvent(new Event('input'));
                document.getElementById('longitud').dispatchEvent(new Event('input'));
                document.getElementById('ubicacion').dispatchEvent(new Event('input'));
                
                // Actualizar popup con la información
                marker.bindPopup(`
                    <div style="text-align: center; padding: 10px; min-width: 200px;">
                        <strong style="color: #059669;">✓ Ubicación seleccionada</strong><br><br>
                        <div style="color: #374151; font-size: 12px; margin: 5px 0;">${address}</div>
                        <div style="color: #6B7280; font-size: 11px;">
                            Lat: ${lat.toFixed(6)}<br>
                            Lng: ${lng.toFixed(6)}
                        </div>
                    </div>
                `).openPopup();
                
            } catch (error) {
                console.error('Error:', error);
                marker.bindPopup(`
                    <div style="text-align: center; padding: 10px;">
                        <strong style="color: #DC2626;">❌ Error</strong><br><br>
                        <div style="color: #6B7280; font-size: 12px;">No se pudo obtener la dirección</div>
                        <div style="color: #6B7280; font-size: 11px;">
                            Lat: ${lat.toFixed(6)}<br>
                            Lng: ${lng.toFixed(6)}
                        </div>
                    </div>
                `).openPopup();
            }
        });
    
        // Función para buscar ubicación por nombre
        window.searchLocation = async function(query) {
            if (!query) {
                alert('Por favor ingresa una ubicación para buscar');
                return;
            }
            
            // Mostrar indicador de carga
            const searchButton = document.querySelector('button[onclick*="searchLocation"]');
            const originalContent = searchButton.innerHTML;
            searchButton.innerHTML = '<svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            
            try {
                // Buscar primero en El Salvador, luego en general
                let response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5&countrycodes=sv&accept-language=es`);
                let data = await response.json();
                
                // Si no encuentra nada en El Salvador, buscar globalmente
                if (!data || data.length === 0) {
                    response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query + ' El Salvador')}&limit=5&accept-language=es`);
                    data = await response.json();
                }
                
                if (data && data.length > 0) {
                    const result = data[0];
                    const lat = parseFloat(result.lat);
                    const lng = parseFloat(result.lon);
                    
                    // Centrar el mapa en la ubicación encontrada
                    map.setView([lat, lng], 15);
                    
                    // Remover marcador anterior si existe
                    if (marker) {
                        map.removeLayer(marker);
                    }
                    
                    // Agregar marcador directamente
                    marker = L.marker([lat, lng]).addTo(map);
                    
                    // Actualizar campos del formulario
                    document.getElementById('latitud').value = lat;
                    document.getElementById('longitud').value = lng;
                    document.getElementById('ubicacion').value = result.display_name;
                    
                    // Disparar eventos de input para Livewire
                    document.getElementById('latitud').dispatchEvent(new Event('input'));
                    document.getElementById('longitud').dispatchEvent(new Event('input'));
                    document.getElementById('ubicacion').dispatchEvent(new Event('input'));
                    
                    // Mostrar popup con información
                    marker.bindPopup(`
                        <div style="text-align: center; padding: 10px; min-width: 200px;">
                            <strong style="color: #059669;">✓ Ubicación encontrada</strong><br><br>
                            <div style="color: #374151; font-size: 12px; margin: 5px 0;">${result.display_name}</div>
                            <div style="color: #6B7280; font-size: 11px;">
                                Lat: ${lat.toFixed(6)}<br>
                                Lng: ${lng.toFixed(6)}
                            </div>
                        </div>
                    `).openPopup();
                } else {
                    alert('No se encontró la ubicación. Intenta con un término de búsqueda diferente como "Estadio Cuscatlán" o "San Salvador".');
                }
            } catch (error) {
                console.error('Error al buscar la ubicación:', error);
                alert('Error al buscar la ubicación. Verifica tu conexión a internet.');
            } finally {
                // Restaurar botón
                searchButton.innerHTML = originalContent;
            }
        };
        
        // Permitir búsqueda con Enter
        document.getElementById('search-location').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchLocation(this.value);
            }
        });
        
        // Función para redimensionar el mapa
        function resizeMap() {
            setTimeout(function() {
                map.invalidateSize();
            }, 100);
        }
        
        // Redimensionar el mapa cuando sea necesario
        window.addEventListener('resize', resizeMap);
        
        // Redimensionar después de la inicialización
        setTimeout(resizeMap, 500);
        
        // Exponer la función de redimensionamiento globalmente
        window.resizeMap = resizeMap;
        
    }, 200); // Delay de 200ms para asegurar que el DOM esté completamente cargado
});

// Escuchar eventos de Livewire para redimensionar el mapa
document.addEventListener('livewire:updated', function () {
    if (window.resizeMap) {
        setTimeout(window.resizeMap, 100);
    }
});

// También escuchar cuando el DOM se actualiza
document.addEventListener('DOMContentLoaded', function() {
    // Observar cambios en el contenedor del mapa
    const mapContainer = document.getElementById('map');
    if (mapContainer) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && window.resizeMap) {
                    setTimeout(window.resizeMap, 50);
                }
            });
        });
        
        observer.observe(mapContainer, {
            attributes: true,
            attributeFilter: ['style', 'class']
        });
    }
});
</script>
@endpush

