@php
    use Illuminate\Support\Facades\Storage;
@endphp

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* Variables CSS para consistencia - Colores oficiales FESFUT */
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

/* Fuente principal */
.arbitro-form {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Contenedor principal mejorado */
.form-container {
    background: linear-gradient(135deg, var(--fesfut-silver) 0%, var(--fesfut-white) 100%);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-xl);
    overflow: hidden;
    border: 2px solid var(--fesfut-blue);
}

/* Header del formulario */
.form-header {
    background: linear-gradient(135deg, var(--fesfut-blue) 0%, var(--primary-hover) 100%);
    color: var(--fesfut-white);
    padding: 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-bottom: 3px solid var(--fesfut-white);
}

.form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    opacity: 0.3;
}

.form-header h1 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 1;
}

.form-header p {
    margin: 0.5rem 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
    font-weight: 400;
    position: relative;
    z-index: 1;
}

/* Secciones del formulario */
.form-section {
    margin-bottom: 3rem;
    padding: 0 2rem;
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

.section-title {
    flex: 1;
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

/* Campos de entrada mejorados */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
}

.form-label.required::after {
    content: ' *';
    color: var(--error-color);
    font-weight: 700;
}

.form-input, .form-select, .form-textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    font-weight: 400;
    color: var(--gray-800);
    background-color: white;
    transition: all 0.2s ease-in-out;
    box-shadow: var(--shadow-sm);
}

.form-input:focus, .form-select:focus, .form-textarea:focus {
    outline: none;
    border-color: var(--fesfut-blue);
    box-shadow: 0 0 0 3px rgba(0, 63, 127, 0.1);
    transform: translateY(-1px);
}

.form-input:hover, .form-select:hover, .form-textarea:hover {
    border-color: var(--gray-300);
}

.form-input.readonly {
    background-color: var(--gray-50);
    color: var(--gray-600);
    cursor: not-allowed;
}

/* Placeholders mejorados */
.form-input::placeholder, .form-textarea::placeholder {
    color: var(--gray-400);
    font-style: italic;
}

/* Grid responsive mejorado */
.form-grid {
    display: grid;
    gap: 1.5rem;
}

.form-grid-2 {
    grid-template-columns: 1fr 1fr;
}

.form-grid-3 {
    grid-template-columns: 1fr 1fr 1fr;
}

@media (max-width: 768px) {
    .form-grid-2, .form-grid-3 {
        grid-template-columns: 1fr;
    }
    
    .form-section {
        padding: 0 1rem;
    }
    
    .form-header {
        padding: 1.5rem;
    }
    
    .form-header h1 {
        font-size: 1.5rem;
    }
}

/* Mapa mejorado */
.map-container {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    border: 2px solid var(--gray-200);
    transition: all 0.3s ease;
}

.map-container:hover {
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-color);
}

#map {
    height: 450px;
    width: 100%;
}

.map-controls {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 1rem;
}

.map-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background: white;
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-700);
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: var(--shadow-sm);
}

.map-btn:hover {
    background: var(--primary-light);
    border-color: var(--fesfut-blue);
    color: var(--fesfut-blue);
    transform: translateY(-1px);
    box-shadow: var(--shadow);
}

.map-btn i {
    margin-right: 0.5rem;
    font-size: 1rem;
}

/* Subida de archivos mejorada */
.file-upload-area {
    border: 2px dashed var(--gray-300);
    border-radius: var(--border-radius);
    padding: 2rem;
    text-align: center;
    background: var(--gray-50);
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: var(--fesfut-blue);
    background: var(--primary-light);
}

.file-upload-area.dragover {
    border-color: var(--fesfut-blue);
    background: var(--primary-light);
    transform: scale(1.02);
}

.file-input {
    display: none;
}

.file-upload-icon {
    font-size: 3rem;
    color: var(--gray-400);
    margin-bottom: 1rem;
}

.file-upload-text {
    font-size: 1rem;
    font-weight: 500;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
}

.file-upload-hint {
    font-size: 0.875rem;
    color: var(--gray-500);
}

/* Preview de imagen mejorado */
.image-preview {
    margin-top: 1.5rem;
    text-align: center;
}

.image-preview img {
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    border: 3px solid white;
    max-width: 200px;
    height: auto;
}

.image-preview-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-600);
    margin-bottom: 0.75rem;
    display: block;
}

/* Checkbox mejorado */
.checkbox-container {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: var(--gray-50);
    border-radius: var(--border-radius);
    border: 2px solid var(--gray-200);
    transition: all 0.2s ease;
}

.checkbox-container:hover {
    background: var(--primary-light);
    border-color: var(--fesfut-blue);
}

.checkbox-input {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.75rem;
    accent-color: var(--fesfut-blue);
}

.checkbox-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-700);
    cursor: pointer;
}

/* Botones mejorados */
.form-actions {
    background: var(--gray-50);
    padding: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    border-top: 1px solid var(--gray-200);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 2rem;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 2px solid transparent;
    min-width: 120px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--fesfut-blue), var(--primary-hover));
    color: var(--fesfut-white);
    box-shadow: var(--shadow);
    border: 2px solid var(--fesfut-white);
}

.btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.btn-secondary {
    background: white;
    color: var(--gray-700);
    border-color: var(--gray-300);
    box-shadow: var(--shadow-sm);
}

.btn-secondary:hover {
    background: var(--gray-50);
    border-color: var(--gray-400);
    transform: translateY(-1px);
}

.btn i {
    margin-right: 0.5rem;
}

/* Mensajes de error mejorados */
.error-message {
    display: flex;
    align-items: center;
    margin-top: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: var(--border-radius);
    color: var(--error-color);
    font-size: 0.75rem;
    font-weight: 500;
}

.error-message i {
    margin-right: 0.5rem;
    font-size: 0.875rem;
}

/* Loading spinner mejorado */
.loading-spinner {
    display: inline-block;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 1s ease-in-out infinite;
    margin-right: 0.5rem;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Estilos del mapa */
.leaflet-popup-content {
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    line-height: 1.4;
}

.leaflet-control-attribution {
    font-size: 0.75rem;
    background: rgba(255, 255, 255, 0.9) !important;
}

/* Responsive para móviles */
@media (max-width: 768px) {
    #map {
        height: 300px !important;
    }
    
    .form-actions {
        flex-direction: column-reverse;
        gap: 1rem;
    }
    
    .btn {
        width: 100%;
    }
    
    .map-controls {
        justify-content: center;
    }
    
    .map-btn {
        flex: 1;
        justify-content: center;
        min-width: 0;
    }
}

/* Animaciones suaves */
.form-container {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Estados de focus mejorados */
.form-input:focus + .form-label,
.form-select:focus + .form-label,
.form-textarea:focus + .form-label {
    color: var(--fesfut-blue);
}

/* Mejoras de accesibilidad */
.form-input:focus-visible,
.form-select:focus-visible,
.form-textarea:focus-visible,
.btn:focus-visible {
    outline: 2px solid var(--fesfut-blue);
    outline-offset: 2px;
}
</style>
@endpush

<div class="arbitro-form">
<form wire:submit.prevent="save">
    <div class="form-container">
        <!-- Header del Formulario -->
        <div class="form-header">
            <h1>
                <i class="fas fa-user-plus"></i>
                {{ $arbitroId ? 'Editar Árbitro' : 'Nuevo Árbitro' }}
            </h1>
            <p>{{ $arbitroId ? 'Actualiza la información del árbitro seleccionado' : 'Completa los datos para registrar un nuevo árbitro en el sistema' }}</p>
        </div>

        <!-- Información Personal -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="section-title">
                    <h3>Información Personal</h3>
                    <p>Datos básicos de identificación del árbitro</p>
                </div>
            </div>

            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label for="nombre" class="form-label required">Nombre</label>
                    <input type="text" wire:model="nombre" id="nombre" class="form-input" placeholder="Ingrese el nombre del árbitro">
                    @error('nombre') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="apellido" class="form-label required">Apellido</label>
                    <input type="text" wire:model="apellido" id="apellido" class="form-input" placeholder="Ingrese el apellido del árbitro">
                    @error('apellido') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label required">Correo Electrónico</label>
                    <input type="email" wire:model="email" id="email" class="form-input" placeholder="ejemplo@correo.com">
                    @error('email') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" wire:model="telefono" id="telefono" class="form-input" placeholder="+503 7000-0000">
                    @error('telefono') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Información Profesional -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <div class="section-title">
                    <h3>Información Profesional</h3>
                    <p>Categoría y estado actual del árbitro</p>
                </div>
            </div>

            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label for="categoria" class="form-label required">Categoría</label>
                    <select wire:model="categoria" id="categoria" class="form-select">
                        <option value="">Seleccione una categoría</option>
                        <option value="FIFA">🏆 FIFA</option>
                        <option value="Primera">🥇 Primera División</option>
                        <option value="Segunda">🥈 Segunda División</option>
                        <option value="Tercera">🥉 Tercera División</option>
                    </select>
                    @error('categoria') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="estado" class="form-label required">Estado</label>
                    <select wire:model="estado" id="estado" class="form-select">
                        <option value="">Seleccione un estado</option>
                        <option value="disponible">✅ Disponible</option>
                        <option value="ocupado">⏳ Ocupado</option>
                        <option value="inactivo">❌ Inactivo</option>
                    </select>
                    @error('estado') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Información Geográfica -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="section-title">
                    <h3>Información Geográfica</h3>
                    <p>Seleccione la ubicación del árbitro para optimizar asignaciones</p>
                </div>
            </div>

            <!-- Campos de ubicación (se llenan automáticamente) -->
            <div class="form-grid form-grid-3">
                <div class="form-group">
                    <label for="ubicacion" class="form-label required">Dirección</label>
                    <input type="text" wire:model="ubicacion" id="ubicacion" readonly 
                           class="form-input readonly" 
                           placeholder="Seleccione en el mapa">
                    @error('ubicacion') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="latitud" class="form-label">Latitud</label>
                    <input type="number" step="0.00000001" wire:model="latitud" id="latitud" readonly
                           class="form-input readonly" placeholder="Automático">
                    @error('latitud') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="longitud" class="form-label">Longitud</label>
                    <input type="number" step="0.00000001" wire:model="longitud" id="longitud" readonly
                           class="form-input readonly" placeholder="Automático">
                    @error('longitud') 
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Mapa Interactivo -->
            <div class="form-group">
                <div class="map-container" wire:ignore>
                    <div id="map"></div>
                </div>
                
                <!-- Botones de acción del mapa -->
                <div class="map-controls">
                    <button type="button" onclick="getCurrentLocation()" class="map-btn" 
                            title="Obtener mi ubicación actual (requiere HTTPS o localhost)">
                        <i class="fas fa-crosshairs"></i>
                        Mi Ubicación
                    </button>
                    <button type="button" onclick="searchLocation()" class="map-btn"
                            title="Buscar una dirección específica">
                        <i class="fas fa-search"></i>
                        Buscar Dirección
                    </button>
                    <button type="button" onclick="clearLocation()" class="map-btn"
                            title="Limpiar la ubicación seleccionada">
                        <i class="fas fa-trash"></i>
                        Limpiar
                    </button>
                </div>
                
                <p class="mt-3 text-sm text-gray-500 text-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    Haga clic en el mapa para seleccionar la ubicación del árbitro. También puede usar su ubicación actual o buscar una dirección específica.
                </p>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="section-title">
                    <h3>Información Adicional</h3>
                    <p>Observaciones y configuraciones del árbitro</p>
                </div>
            </div>

            <div class="form-group">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea wire:model="observaciones" id="observaciones" rows="4" 
                          class="form-textarea" 
                          placeholder="Notas adicionales sobre el árbitro, especialidades, restricciones, etc."></textarea>
                @error('observaciones') 
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox-container">
                    <input type="checkbox" wire:model="activo" id="activo" class="checkbox-input">
                    <label for="activo" class="checkbox-label">
                        <i class="fas fa-user-check mr-2"></i>
                        Árbitro activo en el sistema
                    </label>
                </div>
                @error('activo') 
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Foto del Árbitro -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <div class="section-title">
                    <h3>Foto del Árbitro</h3>
                    <p>Imagen de perfil del árbitro (opcional)</p>
                </div>
            </div>

            <div class="form-group">
                <div class="file-upload-area" onclick="document.getElementById('foto').click()">
                    <div class="file-upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="file-upload-text">
                        Haga clic para seleccionar una foto
                    </div>
                    <div class="file-upload-hint">
                        PNG, JPG, GIF hasta 1MB
                    </div>
                </div>
                
                <input type="file" wire:model="foto" id="foto" accept="image/*" class="file-input">
                
                @error('foto') 
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

                @if ($foto)
                    <div class="image-preview">
                        <span class="image-preview-label">
                            <i class="fas fa-eye mr-1"></i>
                            Vista previa:
                        </span>
                        <img src="{{ $foto->temporaryUrl() }}" alt="Vista previa">
                    </div>
                @elseif ($currentFoto)
                    <div class="image-preview">
                        <span class="image-preview-label">
                            <i class="fas fa-image mr-1"></i>
                            Foto actual:
                        </span>
                        <img src="{{ Storage::url($currentFoto) }}" alt="Foto actual">
                    </div>
                @endif
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="form-actions">
            <a href="{{ route('arbitros.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Cancelar
            </a>
            
            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                <span wire:loading.remove>
                    <i class="fas fa-{{ $arbitroId ? 'save' : 'plus' }}"></i>
                    {{ $arbitroId ? 'Actualizar Árbitro' : 'Crear Árbitro' }}
                </span>
                <span wire:loading>
                    <div class="loading-spinner"></div>
                    Guardando...
                </span>
            </button>
        </div>
    </div>
</form>

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map;
let marker;
let isMapInitialized = false;
let mapContainer;

// Inicializar el mapa cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(initializeMap, 500);
});

// Manejar eventos de Livewire para preservar el mapa
document.addEventListener('livewire:init', () => {
    // Preservar el mapa durante actualizaciones de Livewire
    Livewire.hook('morph.updating', ({ el, component }) => {
        // Si el elemento que se está actualizando contiene el mapa, preservarlo
        const mapElement = document.getElementById('map');
        if (mapElement && el.contains && el.contains(mapElement)) {
            // Marcar que el mapa debe preservarse
            mapElement.setAttribute('data-preserve-map', 'true');
        }
    });
    
    Livewire.hook('morph.updated', ({ el, component }) => {
        // Verificar si necesitamos reinicializar el mapa
        const mapElement = document.getElementById('map');
        if (mapElement) {
            if (mapElement.hasAttribute('data-preserve-map')) {
                // Remover el atributo y redimensionar el mapa existente
                mapElement.removeAttribute('data-preserve-map');
                if (map) {
                    setTimeout(() => {
                        map.invalidateSize();
                    }, 100);
                }
            } else if (!map || !isMapInitialized) {
                // Solo reinicializar si realmente es necesario
                isMapInitialized = false;
                setTimeout(initializeMap, 100);
            }
        }
    });
    
    // Manejar navegación de Livewire
    Livewire.hook('navigate', () => {
        if (map) {
            map.remove();
            map = null;
            marker = null;
            isMapInitialized = false;
        }
    });
});

function initializeMap() {
    const mapElement = document.getElementById('map');
    
    if (isMapInitialized && map && mapElement) {
        // Si el mapa ya está inicializado y existe, solo redimensionar
        setTimeout(() => {
            if (map) {
                map.invalidateSize();
            }
        }, 100);
        return;
    }
    
    if (!mapElement) {
        console.log('Elemento del mapa no encontrado, reintentando...');
        setTimeout(initializeMap, 500);
        return;
    }
    
    try {
        // Limpiar mapa existente si existe
        if (map) {
            map.remove();
            map = null;
            marker = null;
        }
        
        // Coordenadas por defecto para El Salvador (San Salvador)
        const defaultLat = 13.6929;
        const defaultLng = -89.2182;
        
        // Obtener coordenadas existentes si las hay
        const latInput = document.getElementById('latitud');
        const lngInput = document.getElementById('longitud');
        const ubicacionInput = document.getElementById('ubicacion');
        
        if (!latInput || !lngInput || !ubicacionInput) {
            console.log('Campos de ubicación no encontrados, reintentando...');
            setTimeout(initializeMap, 1000);
            return;
        }
        
        const currentLat = parseFloat(latInput.value) || defaultLat;
        const currentLng = parseFloat(lngInput.value) || defaultLng;
        
        // Crear el mapa con configuración mejorada
        map = L.map('map', {
            center: [currentLat, currentLng],
            zoom: 10,
            zoomControl: true,
            scrollWheelZoom: true,
            doubleClickZoom: true,
            boxZoom: true,
            keyboard: true,
            dragging: true,
            touchZoom: true
        });
        
        // Agregar capa de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19,
            minZoom: 3
        }).addTo(map);
        
        // Si hay coordenadas existentes, agregar marcador
        if (latInput.value && lngInput.value) {
            addMarker(currentLat, currentLng, ubicacionInput.value);
        }
        
        // Evento de clic en el mapa
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            
            console.log(`Clic en mapa: ${lat}, ${lng}`);
            
            // Agregar/mover marcador
            addMarker(lat, lng);
            
            // Obtener dirección usando geocodificación inversa
            reverseGeocode(lat, lng);
        });
        
        // Evento cuando el mapa está listo
        map.whenReady(function() {
            console.log('Mapa listo para usar');
            setTimeout(() => {
                if (map) {
                    map.invalidateSize();
                }
            }, 100);
        });
        
        isMapInitialized = true;
        mapContainer = mapElement;
        
        console.log('Mapa inicializado correctamente');
        
    } catch (error) {
        console.error('Error inicializando el mapa:', error);
        isMapInitialized = false;
        // Reintentar después de un momento
        setTimeout(initializeMap, 2000);
    }
}

function addMarker(lat, lng, address = '') {
    if (!map) {
        console.error('Mapa no inicializado');
        return;
    }
    
    try {
        // Remover marcador existente
        if (marker) {
            map.removeLayer(marker);
            marker = null;
        }
        
        // Agregar nuevo marcador
        marker = L.marker([lat, lng], {
            draggable: true,
            title: 'Ubicación del árbitro - Arrastrar para ajustar'
        }).addTo(map);
        
        // Evento cuando se arrastra el marcador
        marker.on('dragend', function(e) {
            const newLat = e.target.getLatLng().lat;
            const newLng = e.target.getLatLng().lng;
            console.log(`Marcador arrastrado a: ${newLat}, ${newLng}`);
            reverseGeocode(newLat, newLng);
        });
        
        // Actualizar campos
        updateLocationFields(lat, lng, address);
        
        // Popup con información
        const popupContent = address ? 
            `<div style="text-align: center;">
                <b>📍 Ubicación seleccionada</b><br>
                <span style="color: #666;">${address}</span><br>
                <small style="color: #999;">Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}</small>
            </div>` :
            `<div style="text-align: center;">
                <b>📍 Ubicación seleccionada</b><br>
                <small style="color: #999;">Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}</small>
            </div>`;
            
        marker.bindPopup(popupContent).openPopup();
        
        console.log(`Marcador agregado en: ${lat}, ${lng}`);
        
    } catch (error) {
        console.error('Error agregando marcador:', error);
    }
}

function updateLocationFields(lat, lng, address = '') {
    try {
        const latInput = document.getElementById('latitud');
        const lngInput = document.getElementById('longitud');
        const ubicacionInput = document.getElementById('ubicacion');
        
        if (!latInput || !lngInput || !ubicacionInput) {
            console.error('No se encontraron los campos de ubicación');
            return;
        }
        
        // Actualizar campos del formulario sin disparar eventos
        const latValue = lat.toFixed(8);
        const lngValue = lng.toFixed(8);
        
        latInput.value = latValue;
        lngInput.value = lngValue;
        
        if (address) {
            ubicacionInput.value = address;
        }
        
        // Actualizar Livewire usando wire:model.defer para evitar re-renderizado inmediato
        if (window.Livewire && @this) {
            @this.set('latitud', latValue);
            @this.set('longitud', lngValue);
            if (address) {
                @this.set('ubicacion', address);
            }
        }
        
        console.log(`Ubicación actualizada: ${latValue}, ${lngValue}, ${address}`);
        
    } catch (error) {
        console.error('Error actualizando campos de ubicación:', error);
    }
}

function reverseGeocode(lat, lng) {
    // Usar Nominatim para geocodificación inversa
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
        .then(response => response.json())
        .then(data => {
            let address = '';
            
            if (data.display_name) {
                // Formatear la dirección para El Salvador
                const addressParts = [];
                
                if (data.address) {
                    if (data.address.house_number && data.address.road) {
                        addressParts.push(`${data.address.road} ${data.address.house_number}`);
                    } else if (data.address.road) {
                        addressParts.push(data.address.road);
                    }
                    
                    if (data.address.suburb || data.address.neighbourhood) {
                        addressParts.push(data.address.suburb || data.address.neighbourhood);
                    }
                    
                    if (data.address.city || data.address.town || data.address.village) {
                        addressParts.push(data.address.city || data.address.town || data.address.village);
                    }
                    
                    if (data.address.state) {
                        addressParts.push(data.address.state);
                    }
                }
                
                address = addressParts.length > 0 ? addressParts.join(', ') : data.display_name;
            } else {
                address = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
            }
            
            updateLocationFields(lat, lng, address);
            
            // Actualizar popup del marcador
            if (marker) {
                marker.bindPopup(`<b>Ubicación seleccionada:</b><br>${address}`).openPopup();
            }
        })
        .catch(error => {
            console.error('Error en geocodificación:', error);
            updateLocationFields(lat, lng, `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`);
        });
}

function getCurrentLocation() {
    // Verificar si la geolocalización está disponible
    if (!navigator.geolocation) {
        showLocationError('La geolocalización no está soportada en este navegador.');
        return;
    }
    
    // Verificar si estamos en un contexto seguro
    if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
        showLocationFallback();
        return;
    }
    
    // Mostrar indicador de carga
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Obteniendo ubicación...';
    button.disabled = true;
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            
            console.log(`Ubicación obtenida: ${lat}, ${lng}`);
            
            // Centrar mapa en la ubicación actual
            map.setView([lat, lng], 15);
            
            // Agregar marcador
            addMarker(lat, lng);
            
            // Obtener dirección
            reverseGeocode(lat, lng);
            
            // Restaurar botón
            button.innerHTML = originalText;
            button.disabled = false;
            
            // Mostrar mensaje de éxito
            showLocationSuccess('Ubicación obtenida correctamente');
        },
        function(error) {
            console.error('Error de geolocalización:', error);
            
            // Restaurar botón
            button.innerHTML = originalText;
            button.disabled = false;
            
            // Manejar diferentes tipos de error
            let errorMessage = '';
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = 'Permiso de ubicación denegado. Por favor, habilite la ubicación en su navegador.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = 'Información de ubicación no disponible.';
                    break;
                case error.TIMEOUT:
                    errorMessage = 'Tiempo de espera agotado para obtener la ubicación.';
                    break;
                default:
                    if (error.message.includes('Only secure origins are allowed')) {
                        showLocationFallback();
                        return;
                    }
                    errorMessage = 'Error desconocido obteniendo ubicación: ' + error.message;
                    break;
            }
            
            showLocationError(errorMessage);
        },
        {
            enableHighAccuracy: true,
            timeout: 15000,
            maximumAge: 300000 // 5 minutos
        }
    );
}

function showLocationFallback() {
    const fallbackModal = `
        <div id="locationFallbackModal" style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        ">
            <div style="
                background: white;
                padding: 2rem;
                border-radius: 12px;
                max-width: 500px;
                margin: 1rem;
                box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            ">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #f59e0b; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                        Geolocalización no disponible
                    </h3>
                    <p style="color: #6b7280; font-size: 0.875rem;">
                        La geolocalización automática no está disponible en este contexto. 
                        Puede usar las siguientes alternativas:
                    </p>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <h4 style="font-weight: 600; color: #374151; margin-bottom: 0.75rem;">
                        <i class="fas fa-lightbulb" style="color: #10b981; margin-right: 0.5rem;"></i>
                        Alternativas disponibles:
                    </h4>
                    <ul style="list-style: none; padding: 0; color: #6b7280; font-size: 0.875rem;">
                        <li style="margin-bottom: 0.5rem;">
                            <i class="fas fa-mouse-pointer" style="color: #4f46e5; margin-right: 0.5rem;"></i>
                            Haga clic directamente en el mapa
                        </li>
                        <li style="margin-bottom: 0.5rem;">
                            <i class="fas fa-search" style="color: #4f46e5; margin-right: 0.5rem;"></i>
                            Use el botón "Buscar Dirección"
                        </li>
                        <li style="margin-bottom: 0.5rem;">
                            <i class="fas fa-arrows-alt" style="color: #4f46e5; margin-right: 0.5rem;"></i>
                            Arrastre el marcador para ajustar
                        </li>
                    </ul>
                </div>
                
                <div style="margin-bottom: 1.5rem; padding: 1rem; background: #f3f4f6; border-radius: 8px;">
                    <h4 style="font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.875rem;">
                        <i class="fas fa-info-circle" style="color: #3b82f6; margin-right: 0.5rem;"></i>
                        ¿Por qué no funciona?
                    </h4>
                    <p style="color: #6b7280; font-size: 0.75rem; margin: 0;">
                        Los navegadores requieren HTTPS o localhost para acceder a la ubicación por seguridad.
                        Como está usando una IP local, esta función no está disponible.
                    </p>
                </div>
                
                <div style="text-align: center;">
                    <button onclick="closeLocationFallback()" style="
                        background: linear-gradient(135deg, #003f7f, #4a90e2);
                        color: white;
                        border: none;
                        padding: 0.75rem 2rem;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        font-size: 0.875rem;
                    ">
                        <i class="fas fa-check" style="margin-right: 0.5rem;"></i>
                        Entendido
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', fallbackModal);
}

function closeLocationFallback() {
    const modal = document.getElementById('locationFallbackModal');
    if (modal) {
        modal.remove();
    }
}

function showLocationError(message) {
    // Crear notificación de error elegante
    const errorNotification = `
        <div id="locationError" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            z-index: 9999;
            max-width: 400px;
            animation: slideInRight 0.3s ease-out;
        ">
            <div style="display: flex; align-items: center;">
                <i class="fas fa-exclamation-circle" style="font-size: 1.25rem; margin-right: 0.75rem;"></i>
                <div>
                    <div style="font-weight: 600; margin-bottom: 0.25rem;">Error de Ubicación</div>
                    <div style="font-size: 0.875rem; opacity: 0.9;">${message}</div>
                </div>
                <button onclick="closeLocationError()" style="
                    background: none;
                    border: none;
                    color: white;
                    font-size: 1.25rem;
                    cursor: pointer;
                    margin-left: 1rem;
                    opacity: 0.7;
                ">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <style>
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        </style>
    `;
    
    document.body.insertAdjacentHTML('beforeend', errorNotification);
    
    // Auto-cerrar después de 5 segundos
    setTimeout(() => {
        closeLocationError();
    }, 5000);
}

function showLocationSuccess(message) {
    // Crear notificación de éxito elegante
    const successNotification = `
        <div id="locationSuccess" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            z-index: 9999;
            max-width: 400px;
            animation: slideInRight 0.3s ease-out;
        ">
            <div style="display: flex; align-items: center;">
                <i class="fas fa-check-circle" style="font-size: 1.25rem; margin-right: 0.75rem;"></i>
                <div>
                    <div style="font-weight: 600; margin-bottom: 0.25rem;">¡Éxito!</div>
                    <div style="font-size: 0.875rem; opacity: 0.9;">${message}</div>
                </div>
                <button onclick="closeLocationSuccess()" style="
                    background: none;
                    border: none;
                    color: white;
                    font-size: 1.25rem;
                    cursor: pointer;
                    margin-left: 1rem;
                    opacity: 0.7;
                ">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', successNotification);
    
    // Auto-cerrar después de 3 segundos
    setTimeout(() => {
        closeLocationSuccess();
    }, 3000);
}

function closeLocationError() {
    const error = document.getElementById('locationError');
    if (error) {
        error.remove();
    }
}

function closeLocationSuccess() {
    const success = document.getElementById('locationSuccess');
    if (success) {
        success.remove();
    }
}

function searchLocation() {
    // Crear modal de búsqueda elegante
    const searchModal = `
        <div id="searchLocationModal" style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        ">
            <div style="
                background: white;
                padding: 2rem;
                border-radius: 12px;
                max-width: 500px;
                width: 90%;
                margin: 1rem;
                box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            ">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-search-location" style="font-size: 3rem; color: #4f46e5; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                        Buscar Dirección
                    </h3>
                    <p style="color: #6b7280; font-size: 0.875rem;">
                        Ingrese la dirección que desea buscar en El Salvador
                    </p>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <input type="text" id="searchInput" placeholder="Ej: San Salvador, Centro Histórico" style="
                        width: 100%;
                        padding: 0.75rem 1rem;
                        border: 2px solid #e5e7eb;
                        border-radius: 8px;
                        font-size: 0.875rem;
                        box-sizing: border-box;
                    " onkeypress="if(event.key==='Enter') performSearch()">
                </div>
                
                <div id="searchResults" style="
                    max-height: 200px;
                    overflow-y: auto;
                    margin-bottom: 1.5rem;
                    display: none;
                "></div>
                
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <button onclick="closeSearchModal()" style="
                        background: #f3f4f6;
                        color: #374151;
                        border: none;
                        padding: 0.75rem 1.5rem;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        font-size: 0.875rem;
                    ">
                        <i class="fas fa-times" style="margin-right: 0.5rem;"></i>
                        Cancelar
                    </button>
                    <button onclick="performSearch()" style="
                        background: linear-gradient(135deg, #003f7f, #4a90e2);
                        color: white;
                        border: none;
                        padding: 0.75rem 1.5rem;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        font-size: 0.875rem;
                    ">
                        <i class="fas fa-search" style="margin-right: 0.5rem;"></i>
                        Buscar
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', searchModal);
    
    // Enfocar el input
    setTimeout(() => {
        document.getElementById('searchInput').focus();
    }, 100);
}

function performSearch() {
    const query = document.getElementById('searchInput').value.trim();
    if (!query) {
        showLocationError('Por favor, ingrese una dirección para buscar.');
        return;
    }
    
    const searchButton = event.target;
    const originalText = searchButton.innerHTML;
    searchButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Buscando...';
    searchButton.disabled = true;
    
    // Buscar usando Nominatim
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query + ', El Salvador')}&limit=5&addressdetails=1`)
        .then(response => response.json())
        .then(data => {
            searchButton.innerHTML = originalText;
            searchButton.disabled = false;
            
            if (data.length > 0) {
                displaySearchResults(data);
            } else {
                showLocationError(`No se encontraron resultados para: "${query}"`);
            }
        })
        .catch(error => {
            console.error('Error en búsqueda:', error);
            searchButton.innerHTML = originalText;
            searchButton.disabled = false;
            showLocationError('Error al buscar la dirección. Verifique su conexión a internet.');
        });
}

function displaySearchResults(results) {
    const resultsContainer = document.getElementById('searchResults');
    
    let resultsHTML = '<h4 style="font-weight: 600; color: #374151; margin-bottom: 0.75rem; font-size: 0.875rem;">Resultados encontrados:</h4>';
    
    results.forEach((result, index) => {
        const lat = parseFloat(result.lat);
        const lng = parseFloat(result.lon);
        
        resultsHTML += `
            <div onclick="selectSearchResult(${lat}, ${lng}, '${result.display_name.replace(/'/g, "\\'")}'); closeSearchModal();" style="
                padding: 0.75rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                margin-bottom: 0.5rem;
                cursor: pointer;
                transition: all 0.2s ease;
                background: white;
            " onmouseover="this.style.background='#f3f4f6'; this.style.borderColor='#003f7f';" 
               onmouseout="this.style.background='white'; this.style.borderColor='#e5e7eb';">
                <div style="font-weight: 600; color: #374151; font-size: 0.875rem; margin-bottom: 0.25rem;">
                    <i class="fas fa-map-marker-alt" style="color: #003f7f; margin-right: 0.5rem;"></i>
                    ${result.display_name.split(',')[0]}
                </div>
                <div style="color: #6b7280; font-size: 0.75rem;">
                    ${result.display_name}
                </div>
                <div style="color: #9ca3af; font-size: 0.75rem; margin-top: 0.25rem;">
                    Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}
                </div>
            </div>
        `;
    });
    
    resultsContainer.innerHTML = resultsHTML;
    resultsContainer.style.display = 'block';
}

function selectSearchResult(lat, lng, displayName) {
    console.log(`Resultado seleccionado: ${lat}, ${lng}, ${displayName}`);
    
    // Centrar mapa en el resultado
    map.setView([lat, lng], 15);
    
    // Agregar marcador
    addMarker(lat, lng, displayName);
    
    // Mostrar mensaje de éxito
    showLocationSuccess('Ubicación encontrada y seleccionada correctamente');
}

function closeSearchModal() {
    const modal = document.getElementById('searchLocationModal');
    if (modal) {
        modal.remove();
    }
}

function clearLocation() {
    try {
        // Remover marcador
        if (marker && map) {
            map.removeLayer(marker);
            marker = null;
        }
        
        const latInput = document.getElementById('latitud');
        const lngInput = document.getElementById('longitud');
        const ubicacionInput = document.getElementById('ubicacion');
        
        if (latInput && lngInput && ubicacionInput) {
            // Limpiar campos
            ubicacionInput.value = '';
            latInput.value = '';
            lngInput.value = '';
            
            // Disparar eventos
            ubicacionInput.dispatchEvent(new Event('input', { bubbles: true }));
            latInput.dispatchEvent(new Event('input', { bubbles: true }));
            lngInput.dispatchEvent(new Event('input', { bubbles: true }));
            
            // Actualizar Livewire
            if (window.Livewire && @this) {
                @this.set('ubicacion', '');
                @this.set('latitud', '');
                @this.set('longitud', '');
            }
        }
        
        // Centrar en El Salvador
        if (map) {
            map.setView([13.6929, -89.2182], 10);
        }
        
    } catch (error) {
        console.error('Error limpiando ubicación:', error);
    }
}

// Redimensionar mapa cuando cambie el tamaño de la ventana
window.addEventListener('resize', function() {
    if (map) {
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
    }
});

// Funcionalidad de drag & drop para subida de archivos
document.addEventListener('DOMContentLoaded', function() {
    const fileUploadArea = document.querySelector('.file-upload-area');
    const fileInput = document.getElementById('foto');
    
    if (fileUploadArea && fileInput) {
        // Prevenir comportamiento por defecto
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });
        
        // Resaltar área de drop
        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        // Manejar archivos soltados
        fileUploadArea.addEventListener('drop', handleDrop, false);
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        function highlight(e) {
            fileUploadArea.classList.add('dragover');
        }
        
        function unhighlight(e) {
            fileUploadArea.classList.remove('dragover');
        }
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                const file = files[0];
                
                // Validar que sea una imagen
                if (file.type.startsWith('image/')) {
                    // Crear un nuevo FileList
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    
                    // Disparar evento change
                    fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                } else {
                    alert('Por favor, seleccione solo archivos de imagen (PNG, JPG, GIF).');
                }
            }
        }
    }
});
</script>
@endpush

</div>
