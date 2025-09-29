@extends('layouts.masteraprendiz')

@section('content')
@vite(['resources/css/waste.css'])

<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="waste-header animate-fade-in-up">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="waste-title">
                    <i class="fas fa-eye waste-icon"></i>
                    Detalles del Residuo Orgánico
                </h1>
                <p class="waste-subtitle">
                    <i class="fas fa-user-graduate text-green-400 mr-2"></i>
                    {{ Auth::user()->name }} - Registro #{{ str_pad($organic->id, 3, '0', STR_PAD_LEFT) }}
                </p>
            </div>
            <div class="text-right">
                <div class="text-green-400 font-bold text-lg">{{ \Carbon\Carbon::now()->setTimezone('America/Bogota')->format('d/m/Y') }}</div>    
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="waste-container animate-fade-in-up animate-delay-2">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-info-circle text-green-600 mr-2"></i>
                Información del Registro
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('aprendiz.organic.index') }}" 
                   class="bg-gray-400 text-gray-800 border border-gray-500 hover:bg-gray-500 px-4 py-2 rounded-lg transition-all duration-200 flex items-center shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver a la Lista
                </a>
                @if($organic->created_by == auth()->id())
                    <form action="{{ route('aprendiz.organic.request-edit', $organic) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-green-400 text-green-800 border border-green-500 hover:bg-green-500 px-4 py-2 rounded-lg transition-all duration-200 flex items-center shadow-sm"
                                onclick="return confirm('¿Desea solicitar permiso al administrador para editar este registro?')">
                            <i class="fas fa-edit mr-2"></i>
                            Solicitar Edición
                        </button>
                    </form>
                    <form action="{{ route('aprendiz.organic.request-delete', $organic) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-red-400 text-red-800 border border-red-500 hover:bg-red-500 px-4 py-2 rounded-lg transition-all duration-200 flex items-center shadow-sm"
                                onclick="return confirm('¿Desea solicitar permiso al administrador para eliminar este registro?')">
                            <i class="fas fa-trash mr-2"></i>
                            Solicitar Eliminación
                        </button>
                    </form>
                @else
                    <button onclick="showPermissionAlert()" 
                            class="bg-gray-300 text-gray-600 cursor-not-allowed px-4 py-2 rounded-lg flex items-center shadow-sm">
                        <i class="fas fa-lock mr-2"></i>
                        Sin Permisos
                    </button>
                @endif
            </div>
        </div>

        <!-- Image Section -->
        <div class="mb-8 text-center">
            @if($organic->img)
                @php
                    $imageUrl = route('storage.local', ['path' => $organic->img]);
                @endphp
                <img src="{{ $imageUrl }}?v={{ $organic->updated_at->timestamp }}" 
                     alt="Imagen del residuo orgánico" 
                     class="max-w-full h-64 object-cover rounded-lg shadow-md mx-auto cursor-pointer hover:opacity-90 transition-opacity"
                     onclick="openImageModal('{{ $imageUrl }}?v={{ $organic->updated_at->timestamp }}')">
            @else
                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-image text-6xl mb-4"></i>
                        <p class="text-lg">Sin imagen disponible</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Fecha -->
            <div class="waste-form-group">
                <label class="waste-form-label">Fecha</label>
                <div class="waste-form-input bg-gray-50">{{ $organic->formatted_date }}</div>
            </div>

            <!-- Tipo de Residuo -->
            <div class="waste-form-group">
                <label class="waste-form-label">Tipo de Residuo</label>
                <div class="waste-form-input bg-gray-50">
                    <span class="waste-badge 
                        @if($organic->type == 'Kitchen') waste-badge-success
                        @elseif($organic->type == 'Beds') waste-badge-info
                        @elseif($organic->type == 'Leaves') waste-badge-warning
                        @else waste-badge-primary
                        @endif">
                        {{ $organic->type_in_spanish }}
                    </span>
                </div>
            </div>

            <!-- Peso -->
            <div class="waste-form-group">
                <label class="waste-form-label">Peso (Kg)</label>
                <div class="waste-form-input bg-gray-50 font-semibold">{{ $organic->formatted_weight }}</div>
            </div>

            <!-- Entregado Por -->
            <div class="waste-form-group">
                <label class="waste-form-label">Entregado Por</label>
                <div class="waste-form-input bg-gray-50">{{ $organic->delivered_by }}</div>
            </div>

            <!-- Recibido Por -->
            <div class="waste-form-group">
                <label class="waste-form-label">Recibido Por</label>
                <div class="waste-form-input bg-gray-50">{{ $organic->received_by }}</div>
            </div>

            <!-- Fecha de Creación -->
            <div class="waste-form-group">
                <label class="waste-form-label">Fecha de Creación</label>
                <div class="waste-form-input bg-gray-50">{{ $organic->created_at_formatted }}</div>
            </div>

            <!-- Creado Por -->
            <div class="waste-form-group">
                <label class="waste-form-label">Creado Por</label>
                <div class="waste-form-input bg-gray-50">
                    <div class="flex items-center">
                        @if($organic->created_by == auth()->id())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2">
                                <i class="fas fa-user mr-1"></i>
                                Propio
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                <i class="fas fa-users mr-1"></i>
                                Otro
                            </span>
                        @endif
                        {{ $organic->created_by_info }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Notas -->
        @if($organic->notes)
            <div class="waste-form-group">
                <label class="waste-form-label">Notas</label>
                <div class="waste-form-textarea bg-gray-50" style="min-height: 100px;">{{ $organic->notes }}</div>
            </div>
        @endif
    </div>
</div>

<!-- Modal para visualizar imagen -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 modal-backdrop-blur hidden z-50 flex items-center justify-center p-4">
    <div class="relative max-w-6xl max-h-[90vh] w-full flex items-center justify-center">
        <!-- Botón de cerrar -->
        <button onclick="closeImageModal()" class="absolute top-4 right-4 z-10 bg-black bg-opacity-50 text-white rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-75 transition-all">
            <i class="fas fa-times text-xl"></i>
        </button>
        
        <!-- Imagen -->
        <img id="modalImage" src="" alt="Imagen del residuo orgánico" 
             class="max-w-4xl max-h-[80vh] w-auto h-auto object-contain rounded-lg shadow-2xl mx-auto">
    </div>
</div>

<script>
// Funciones para el modal de imagen
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Cerrar modal de imagen al hacer clic fuera
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Cerrar modal de imagen con tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Funciones para manejar permisos
function requestEditPermission(organicId) {
    if (confirm('¿Desea solicitar permiso al administrador para editar este registro?')) {
        // Aquí se implementaría la lógica para solicitar permiso
        alert('Solicitud de edición enviada al administrador. Recibirá una notificación cuando sea aprobada.');
    }
}

function requestDeletePermission(organicId) {
    if (confirm('¿Desea solicitar permiso al administrador para eliminar este registro?')) {
        // Aquí se implementaría la lógica para solicitar permiso
        alert('Solicitud de eliminación enviada al administrador. Recibirá una notificación cuando sea aprobada.');
    }
}

function showPermissionAlert() {
    alert('No tiene permisos para realizar esta acción. Solo puede editar o eliminar sus propios registros.');
}
</script>
@endsection
