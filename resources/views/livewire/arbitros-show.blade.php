@push('styles')
<!-- Leaflet CSS para el mapa -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        /* Colores oficiales de la Federación Salvadoreña de Fútbol (FESFUT) */
        --primary-color: #003f7f; /* Azul FESFUT principal */
        --primary-hover: #002a5c; /* Azul FESFUT oscuro */
        --primary-light: #e6f2ff; /* Azul FESFUT claro */
        --secondary-color: #0066cc; /* Azul FESFUT secundario */
        --accent-color: #ffffff; /* Blanco FESFUT */
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --error-color: #ef4444;
        --fesfut-blue: #003f7f; /* Azul oficial FESFUT */
        --fesfut-light-blue: #4a90e2; /* Azul claro FESFUT */
        --fesfut-white: #ffffff; /* Blanco oficial */
        --fesfut-silver: #f8f9fa; /* Plata/gris muy claro */
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --border-radius: 12px;
        --border-radius-lg: 16px;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }

    .arbitro-details {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, var(--fesfut-silver) 0%, var(--fesfut-white) 100%);
        min-height: 100vh;
    }

    .profile-header {
        background: linear-gradient(135deg, var(--fesfut-blue) 0%, var(--primary-hover) 100%);
        border-radius: var(--border-radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-xl);
        position: relative;
        overflow: hidden;
        border: 3px solid var(--fesfut-white);
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: 0.3;
    }

    .profile-avatar {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.2);
        box-shadow: var(--shadow-lg);
        transition: all 0.3s ease;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .profile-avatar-placeholder {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        border: 4px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        box-shadow: var(--shadow-lg);
    }

    .info-card {
        background: white;
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-200);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        border-color: var(--fesfut-blue);
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--gray-100);
    }

    .section-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: linear-gradient(135deg, var(--fesfut-blue), var(--fesfut-light-blue));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: var(--fesfut-white);
        font-size: 1.1rem;
        border: 2px solid var(--fesfut-white);
        box-shadow: var(--shadow);
    }

    .section-title h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--gray-800);
        margin: 0;
    }

    .section-title p {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin: 0.25rem 0 0 0;
    }

    .data-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .data-item {
        display: flex;
        flex-direction: column;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: var(--border-radius);
        border: 1px solid var(--gray-200);
        transition: all 0.2s ease;
    }

    .data-item:hover {
        background: var(--primary-light);
        border-color: var(--fesfut-blue);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .data-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .data-value {
        font-size: 1rem;
        font-weight: 500;
        color: var(--gray-900);
        word-break: break-word;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .map-container {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        border: 2px solid var(--gray-200);
        height: 300px;
        position: relative;
    }

    #detailMap {
        height: 100%;
        width: 100%;
    }

    .coordinates-info {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.95);
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius);
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--gray-700);
        box-shadow: var(--shadow);
        z-index: 1000;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .stat-card {
        background: linear-gradient(135deg, var(--fesfut-blue), var(--fesfut-light-blue));
        color: var(--fesfut-white);
        padding: 1.5rem;
        border-radius: var(--border-radius);
        text-align: center;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        border: 2px solid var(--fesfut-white);
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        opacity: 0.9;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .partido-card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
    }

    .partido-card:hover {
        border-color: var(--fesfut-blue);
        box-shadow: var(--shadow);
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--gray-500);
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 1.5rem;
        }
        
        .profile-avatar, .profile-avatar-placeholder {
            width: 6rem;
            height: 6rem;
        }
        
        .data-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush

<div class="arbitro-details">
    <!-- Header del Perfil -->
    <div class="profile-header">
        <div class="relative z-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex flex-col sm:flex-row sm:items-center gap-6 mb-6 lg:mb-0">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        @if ($arbitro->foto)
                            <img src="{{ Storage::url($arbitro->foto) }}" 
                                 alt="Foto de {{ $arbitro->nombre_completo }}" 
                                 class="profile-avatar">
                        @else
                            <div class="profile-avatar-placeholder">
                                {{ substr($arbitro->nombre, 0, 1) }}{{ substr($arbitro->apellido, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Información Principal -->
                    <div class="text-white">
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">
                            {{ $arbitro->nombre_completo }}
                        </h1>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-3">
                            <!-- Categoría -->
                            <div class="category-badge" style="background: rgba(255, 255, 255, 0.2); color: white;">
                                @if($arbitro->categoria === 'FIFA') 
                                    <i class="fas fa-trophy"></i> FIFA
                                @elseif($arbitro->categoria === 'Primera') 
                                    <i class="fas fa-medal"></i> Primera División
                                @elseif($arbitro->categoria === 'Segunda') 
                                    <i class="fas fa-award"></i> Segunda División
                                @else 
                                    <i class="fas fa-star"></i> {{ $arbitro->categoria }}
                                @endif
                            </div>
                            
                            <!-- Estado -->
                            <div class="status-badge" style="
                                @if($arbitro->estado === 'disponible') background: rgba(16, 185, 129, 0.2); color: #10b981;
                                @elseif($arbitro->estado === 'ocupado') background: rgba(239, 68, 68, 0.2); color: #ef4444;
                                @else background: rgba(107, 114, 128, 0.2); color: #6b7280;
                                @endif
                            ">
                                @if($arbitro->estado === 'disponible') 
                                    <i class="fas fa-check-circle"></i> Disponible
                                @elseif($arbitro->estado === 'ocupado') 
                                    <i class="fas fa-clock"></i> Ocupado
                                @else 
                                    <i class="fas fa-pause-circle"></i> {{ ucfirst($arbitro->estado) }}
                                @endif
                            </div>
                            
                            <!-- Estado Activo -->
                            <div class="status-badge" style="
                                @if($arbitro->activo) background: rgba(16, 185, 129, 0.2); color: #10b981;
                                @else background: rgba(107, 114, 128, 0.2); color: #6b7280;
                                @endif
                            ">
                                @if($arbitro->activo) 
                                    <i class="fas fa-user-check"></i> Activo
                                @else 
                                    <i class="fas fa-user-times"></i> Inactivo
                                @endif
                            </div>
                        </div>
                        
                        <p class="text-indigo-100 text-lg">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $arbitro->ubicacion ?? 'Ubicación no especificada' }}
                        </p>
                        
                        @if($arbitro->email)
                            <p class="text-indigo-100">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $arbitro->email }}
                            </p>
                        @endif
                    </div>
                </div>
                
                <!-- Botones de Acción -->
                <div class="flex flex-col gap-3">
                    <!-- Estadísticas Rápidas -->
                    <div class="stats-grid">
                        <div class="stat-card" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));">
                            <div class="stat-icon">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <div class="stat-value">{{ $arbitro->partidos_arbitrados ?? 0 }}</div>
                            <div class="stat-label">Partidos Arbitrados</div>
                        </div>
                        
                        <div class="stat-card" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-value">
                                @if($arbitro->fecha_ultima_designacion)
                                    {{ $arbitro->fecha_ultima_designacion->diffForHumans() }}
                                @else
                                    N/A
                                @endif
                            </div>
                            <div class="stat-label">Última Designación</div>
                        </div>
                    </div>
                    
                    <!-- Botones de Acción -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-end">
                        @if($arbitro->latitud && $arbitro->longitud)
                            <button onclick="copyCoordinates()" 
                                    class="px-3 py-2 bg-white bg-opacity-20 text-white rounded-lg hover:bg-opacity-30 transition-all duration-200 text-sm font-medium"
                                    title="Copiar coordenadas">
                                <i class="fas fa-copy mr-1"></i>
                                Coordenadas
                            </button>
                        @endif
                        
                        <button onclick="exportArbitroData()" 
                                class="px-3 py-2 bg-white bg-opacity-20 text-white rounded-lg hover:bg-opacity-30 transition-all duration-200 text-sm font-medium"
                                title="Exportar datos">
                            <i class="fas fa-download mr-1"></i>
                            Exportar
                        </button>
                        
                        <button onclick="printProfile()" 
                                class="px-3 py-2 bg-white bg-opacity-20 text-white rounded-lg hover:bg-opacity-30 transition-all duration-200 text-sm font-medium"
                                title="Imprimir perfil">
                            <i class="fas fa-print mr-1"></i>
                            Imprimir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información Personal -->
    <div class="info-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="section-title">
                <h3>Información Personal</h3>
                <p>Datos básicos de identificación del árbitro</p>
            </div>
        </div>
        
        <div class="data-grid">
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-user"></i>
                    Nombre Completo
                </div>
                <div class="data-value">{{ $arbitro->nombre_completo }}</div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-envelope"></i>
                    Correo Electrónico
                </div>
                <div class="data-value">{{ $arbitro->email ?? 'No especificado' }}</div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-phone"></i>
                    Teléfono
                </div>
                <div class="data-value">{{ $arbitro->telefono ?? 'No especificado' }}</div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-calendar-plus"></i>
                    Fecha de Registro
                </div>
                <div class="data-value">{{ $arbitro->created_at->format('d/m/Y H:i') }}</div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-edit"></i>
                    Última Actualización
                </div>
                <div class="data-value">{{ $arbitro->updated_at->format('d/m/Y H:i') }}</div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-clock"></i>
                    Tiempo en el Sistema
                </div>
                <div class="data-value">{{ $arbitro->created_at->diffForHumans() }}</div>
            </div>
        </div>
    </div>

    <!-- Información Profesional -->
    <div class="info-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-medal"></i>
            </div>
            <div class="section-title">
                <h3>Información Profesional</h3>
                <p>Categoría, estado y estadísticas del árbitro</p>
            </div>
        </div>
        
        <div class="data-grid">
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-trophy"></i>
                    Categoría
                </div>
                <div class="data-value">
                    <span class="category-badge
                        @if($arbitro->categoria === 'FIFA') bg-gradient-to-r from-purple-500 to-purple-600 text-white
                        @elseif($arbitro->categoria === 'Primera') bg-gradient-to-r from-blue-500 to-blue-600 text-white
                        @elseif($arbitro->categoria === 'Segunda') bg-gradient-to-r from-green-500 to-green-600 text-white
                        @else bg-gradient-to-r from-yellow-500 to-yellow-600 text-white
                        @endif">
                        @if($arbitro->categoria === 'FIFA') 🏆 FIFA
                        @elseif($arbitro->categoria === 'Primera') 🥇 Primera División
                        @elseif($arbitro->categoria === 'Segunda') 🥈 Segunda División
                        @else 🥉 {{ $arbitro->categoria }}
                        @endif
                    </span>
                </div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-toggle-on"></i>
                    Estado Actual
                </div>
                <div class="data-value">
                    <span class="status-badge
                        @if($arbitro->estado === 'disponible') bg-green-100 text-green-800
                        @elseif($arbitro->estado === 'ocupado') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        @if($arbitro->estado === 'disponible') ✅ Disponible
                        @elseif($arbitro->estado === 'ocupado') ⏳ Ocupado
                        @else ❌ {{ ucfirst($arbitro->estado) }}
                        @endif
                    </span>
                </div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-user-check"></i>
                    Estado en Sistema
                </div>
                <div class="data-value">
                    <span class="status-badge
                        @if($arbitro->activo) bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        @if($arbitro->activo) ✅ Activo
                        @else ❌ Inactivo
                        @endif
                    </span>
                </div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-futbol"></i>
                    Partidos Arbitrados
                </div>
                <div class="data-value">{{ $arbitro->partidos_arbitrados ?? 0 }} partidos</div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-calendar-check"></i>
                    Última Designación
                </div>
                <div class="data-value">
                    @if($arbitro->fecha_ultima_designacion)
                        {{ $arbitro->fecha_ultima_designacion->format('d/m/Y') }}
                        <small class="text-gray-500">({{ $arbitro->fecha_ultima_designacion->diffForHumans() }})</small>
                    @else
                        No hay designaciones registradas
                    @endif
                </div>
            </div>
            
            <div class="data-item">
                <div class="data-label">
                    <i class="fas fa-chart-line"></i>
                    Promedio Mensual
                </div>
                <div class="data-value">
                    @php
                        $mesesEnSistema = $arbitro->created_at->diffInMonths(now()) ?: 1;
                        $promedio = round(($arbitro->partidos_arbitrados ?? 0) / $mesesEnSistema, 1);
                    @endphp
                    {{ $promedio }} partidos/mes
                </div>
            </div>
        </div>
    </div>

    <!-- Información Geográfica -->
    <div class="info-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="section-title">
                <h3>Información Geográfica</h3>
                <p>Ubicación y coordenadas del árbitro</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Datos de Ubicación -->
            <div class="data-grid">
                <div class="data-item">
                    <div class="data-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Dirección
                    </div>
                    <div class="data-value">{{ $arbitro->ubicacion ?? 'No especificada' }}</div>
                </div>
                
                <div class="data-item">
                    <div class="data-label">
                        <i class="fas fa-globe-americas"></i>
                        Latitud
                    </div>
                    <div class="data-value">{{ $arbitro->latitud ?? 'No especificada' }}</div>
                </div>
                
                <div class="data-item">
                    <div class="data-label">
                        <i class="fas fa-globe-americas"></i>
                        Longitud
                    </div>
                    <div class="data-value">{{ $arbitro->longitud ?? 'No especificada' }}</div>
                </div>
                
                @if($arbitro->latitud && $arbitro->longitud)
                    <div class="data-item">
                        <div class="data-label">
                            <i class="fas fa-link"></i>
                            Coordenadas
                        </div>
                        <div class="data-value">
                            <a href="https://www.google.com/maps?q={{ $arbitro->latitud }},{{ $arbitro->longitud }}" 
                               target="_blank" 
                               class="text-blue-600 hover:text-blue-800 underline">
                                Ver en Google Maps
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Mapa -->
            @if($arbitro->latitud && $arbitro->longitud)
                <div class="map-container">
                    <div id="detailMap"></div>
                    <div class="coordinates-info">
                        <i class="fas fa-map-pin mr-1"></i>
                        {{ number_format($arbitro->latitud, 6) }}, {{ number_format($arbitro->longitud, 6) }}
                    </div>
                </div>
            @else
                <div class="flex items-center justify-center h-64 bg-gray-100 rounded-lg">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-map-marker-alt text-4xl mb-2"></i>
                        <p>No hay coordenadas disponibles</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Observaciones -->
    @if($arbitro->observaciones)
        <div class="info-card">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="section-title">
                    <h3>Observaciones</h3>
                    <p>Notas adicionales sobre el árbitro</p>
                </div>
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <p class="text-gray-800 leading-relaxed">{{ $arbitro->observaciones }}</p>
            </div>
        </div>
    @endif

    <!-- Historial de Partidos -->
    <div class="info-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-history"></i>
            </div>
            <div class="section-title">
                <h3>Historial de Partidos</h3>
                <p>Registro completo de partidos arbitrados</p>
            </div>
        </div>
        
        @if ($arbitro->partidos && $arbitro->partidos->count() > 0)
            <div class="space-y-4">
                @foreach ($arbitro->partidos->take(10) as $partido)
                    <div class="partido-card">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">
                                    <i class="fas fa-futbol mr-2 text-green-600"></i>
                                    {{ $partido->local->nombre ?? 'Equipo Local' }} vs {{ $partido->visitante->nombre ?? 'Equipo Visitante' }}
                                </h4>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                    <span>
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $partido->fecha ? $partido->fecha->format('d/m/Y') : 'Fecha no disponible' }}
                                    </span>
                                    <span>
                                        <i class="fas fa-user-tie mr-1"></i>
                                        Rol: {{ $partido->pivot->rol ?? 'No especificado' }}
                                    </span>
                                    @if($partido->hora)
                                        <span>
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $partido->hora }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Completado
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                @if($arbitro->partidos->count() > 10)
                    <div class="text-center pt-4">
                        <p class="text-gray-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            Mostrando los últimos 10 partidos de {{ $arbitro->partidos->count() }} total
                        </p>
                    </div>
                @endif
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-futbol"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-700 mb-2">Sin partidos registrados</h4>
                <p class="text-gray-500">Este árbitro aún no tiene partidos asignados en el sistema.</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let detailMap;
let detailMarker;

// Inicializar el mapa cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    initializeDetailMap();
});

function initializeDetailMap() {
    const mapElement = document.getElementById('detailMap');
    
    if (!mapElement) {
        return; // No hay mapa que mostrar
    }
    
    // Obtener coordenadas del árbitro
    const lat = {{ $arbitro->latitud ?? 'null' }};
    const lng = {{ $arbitro->longitud ?? 'null' }};
    
    if (!lat || !lng) {
        return; // No hay coordenadas disponibles
    }
    
    try {
        // Crear el mapa centrado en la ubicación del árbitro
        detailMap = L.map('detailMap', {
            center: [lat, lng],
            zoom: 15,
            zoomControl: true,
            scrollWheelZoom: true,
            doubleClickZoom: true,
            dragging: true,
            touchZoom: true
        });
        
        // Agregar capa de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19,
            minZoom: 3
        }).addTo(detailMap);
        
        // Agregar marcador en la ubicación del árbitro
        const customIcon = L.divIcon({
            className: 'custom-marker',
            html: `
                <div style="
                    background: linear-gradient(135deg, #003f7f, #4a90e2);
                    width: 30px;
                    height: 30px;
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 2px 10px rgba(0,63,127,0.4);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: bold;
                    font-size: 14px;
                ">
                    <i class="fas fa-user"></i>
                </div>
            `,
            iconSize: [36, 36],
            iconAnchor: [18, 18]
        });
        
        detailMarker = L.marker([lat, lng], { 
            icon: customIcon,
            title: '{{ $arbitro->nombre_completo }}'
        }).addTo(detailMap);
        
        // Popup con información del árbitro
        const popupContent = `
            <div style="text-align: center; min-width: 200px;">
                <div style="margin-bottom: 10px;">
                    @if($arbitro->foto)
                        <img src="{{ Storage::url($arbitro->foto) }}" 
                             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #003f7f;">
                    @else
                        <div style="
                            width: 50px; 
                            height: 50px; 
                            border-radius: 50%; 
                            background: linear-gradient(135deg, #003f7f, #4a90e2); 
                            color: white; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center; 
                            font-weight: bold; 
                            margin: 0 auto;
                        ">
                            {{ substr($arbitro->nombre, 0, 1) }}{{ substr($arbitro->apellido, 0, 1) }}
                        </div>
                    @endif
                </div>
                <h4 style="margin: 10px 0 5px 0; color: #1f2937; font-weight: 600;">
                    {{ $arbitro->nombre_completo }}
                </h4>
                <p style="margin: 0 0 5px 0; color: #6b7280; font-size: 14px;">
                    <i class="fas fa-trophy" style="color: #003f7f; margin-right: 5px;"></i>
                    {{ $arbitro->categoria }}
                </p>
                <p style="margin: 0 0 10px 0; color: #6b7280; font-size: 14px;">
                    <i class="fas fa-map-marker-alt" style="color: #003f7f; margin-right: 5px;"></i>
                    {{ Str::limit($arbitro->ubicacion, 30) }}
                </p>
                <div style="font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 8px;">
                    Lat: {{ number_format($arbitro->latitud, 6) }}<br>
                    Lng: {{ number_format($arbitro->longitud, 6) }}
                </div>
            </div>
        `;
        
        detailMarker.bindPopup(popupContent, {
            maxWidth: 250,
            className: 'custom-popup'
        });
        
        // Abrir popup automáticamente
        setTimeout(() => {
            detailMarker.openPopup();
        }, 1000);
        
        // Redimensionar el mapa después de un momento
        setTimeout(() => {
            if (detailMap) {
                detailMap.invalidateSize();
            }
        }, 250);
        
        console.log('Mapa de detalles inicializado correctamente');
        
    } catch (error) {
        console.error('Error inicializando mapa de detalles:', error);
    }
}

// Función para copiar coordenadas al portapapeles
function copyCoordinates() {
    const lat = {{ $arbitro->latitud ?? 'null' }};
    const lng = {{ $arbitro->longitud ?? 'null' }};
    
    if (lat && lng) {
        const coordinates = `${lat}, ${lng}`;
        
        if (navigator.clipboard) {
            navigator.clipboard.writeText(coordinates).then(() => {
                showNotification('Coordenadas copiadas al portapapeles', 'success');
            }).catch(() => {
                fallbackCopyTextToClipboard(coordinates);
            });
        } else {
            fallbackCopyTextToClipboard(coordinates);
        }
    }
}

// Función de respaldo para copiar texto
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showNotification('Coordenadas copiadas al portapapeles', 'success');
    } catch (err) {
        showNotification('Error al copiar coordenadas', 'error');
    }
    
    document.body.removeChild(textArea);
}

// Función para mostrar notificaciones
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full`;
    
    const colors = {
        success: 'bg-green-500 text-white',
        error: 'bg-red-500 text-white',
        info: 'bg-blue-500 text-white',
        warning: 'bg-yellow-500 text-white'
    };
    
    const icons = {
        success: 'fas fa-check-circle',
        error: 'fas fa-exclamation-circle',
        info: 'fas fa-info-circle',
        warning: 'fas fa-exclamation-triangle'
    };
    
    notification.className += ` ${colors[type]}`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="${icons[type]} mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animar entrada
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto-remover después de 3 segundos
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Función para expandir/contraer secciones
function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.classList.toggle('hidden');
    }
}

// Animaciones de entrada para las cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.info-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150);
    });
});

// Función para imprimir el perfil del árbitro
function printProfile() {
    window.print();
}

// Función para exportar datos del árbitro
function exportArbitroData() {
    const arbitroData = {
        nombre: '{{ $arbitro->nombre_completo }}',
        email: '{{ $arbitro->email }}',
        telefono: '{{ $arbitro->telefono }}',
        categoria: '{{ $arbitro->categoria }}',
        estado: '{{ $arbitro->estado }}',
        ubicacion: '{{ $arbitro->ubicacion }}',
        latitud: {{ $arbitro->latitud ?? 'null' }},
        longitud: {{ $arbitro->longitud ?? 'null' }},
        partidos_arbitrados: {{ $arbitro->partidos_arbitrados ?? 0 }},
        activo: {{ $arbitro->activo ? 'true' : 'false' }},
        fecha_registro: '{{ $arbitro->created_at->format('Y-m-d H:i:s') }}',
        observaciones: '{{ $arbitro->observaciones ?? '' }}'
    };
    
    const dataStr = JSON.stringify(arbitroData, null, 2);
    const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
    
    const exportFileDefaultName = `arbitro_${arbitroData.nombre.replace(/\s+/g, '_').toLowerCase()}.json`;
    
    const linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
    
    showNotification('Datos del árbitro exportados correctamente', 'success');
}

// Estilos adicionales para el popup personalizado
const style = document.createElement('style');
style.textContent = `
    .custom-popup .leaflet-popup-content-wrapper {
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    
    .custom-popup .leaflet-popup-tip {
        background: white;
    }
    
    .leaflet-popup-content {
        margin: 15px !important;
    }
    
    @media print {
        .info-card {
            break-inside: avoid;
            margin-bottom: 20px;
        }
        
        .profile-header {
            background: #003f7f !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
    }
`;
document.head.appendChild(style);
</script>
@endpush


