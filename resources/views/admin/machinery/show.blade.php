@extends('layouts.master')

@section('title', 'Detalles de Maquinaria')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <a href="{{ route('machinery.index') }}" 
               class="mr-4 p-2 text-soft-gray-600 hover:text-soft-green-600 rounded-lg hover:bg-soft-green-50 transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-soft-gray-800 mb-2">
                    <i class="fas fa-cogs text-soft-green-600 mr-3"></i>
                    {{ $machinery->name }}
                </h1>
                <p class="text-soft-gray-600">Detalles completos de la maquinaria</p>
            </div>
        </div>
        <div class="flex space-x-2">
            <button type="button" id="openEditModalShow" onclick="openEditModal()"
               class="inline-flex items-center p-2 bg-soft-green-600 text-white rounded-lg hover:bg-soft-green-700 transition-colors"
               title="Editar" aria-label="Editar">
                <i class="fas fa-edit"></i>
            </button>
            <form action="{{ route('machinery.destroy', $machinery) }}" 
                  method="POST" 
                  class="inline"
                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta maquinaria?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                        title="Eliminar" aria-label="Eliminar">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>

<!-- Modal de edición (reutilizado) -->
<div id="editModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative max-w-3xl w-full mx-auto mt-20 bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-soft-green-600 to-soft-green-700 px-6 py-4 flex items-center justify-between">
            <h3 class="text-white font-semibold"><i class="fas fa-edit mr-2"></i>Editar registro de maquinaria</h3>
            <button id="closeEditModal" class="text-white hover:text-soft-gray-200"><i class="fas fa-times"></i></button>
        </div>
        <form id="editForm" method="POST" action="{{ route('machinery.update', $machinery) }}">
            @csrf
            @method('PUT')
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="edit_name" class="block text-sm font-medium text-soft-gray-700 mb-2">Nombre de la maquinaria</label>
                    <input id="edit_name" name="name" type="text" value="{{ $machinery->name }}" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_location" class="block text-sm font-medium text-soft-gray-700 mb-2">Ubicación</label>
                    <input id="edit_location" name="location" type="text" value="{{ $machinery->location }}" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_start_func" class="block text-sm font-medium text-soft-gray-700 mb-2">Fecha de inicio de funcionamiento</label>
                    <input id="edit_start_func" name="start_func" type="date" max="{{ date('Y-m-d') }}" value="{{ $machinery->start_func->format('Y-m-d') }}" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_brand" class="block text-sm font-medium text-soft-gray-700 mb-2">Marca</label>
                    <input id="edit_brand" name="brand" type="text" value="{{ $machinery->brand }}" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_model" class="block text-sm font-medium text-soft-gray-700 mb-2">Modelo</label>
                    <input id="edit_model" name="model" type="text" value="{{ $machinery->model }}" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_serial" class="block text-sm font-medium text-soft-gray-700 mb-2">Número de serie</label>
                    <input id="edit_serial" name="serial" type="text" value="{{ $machinery->serial }}" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 font-mono" />
                </div>
                <div class="md:col-span-2">
                    <label for="edit_maint_freq" class="block text-sm font-medium text-soft-gray-700 mb-2">Frecuencia de mantenimiento</label>
                    <select id="edit_maint_freq" name="maint_freq" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500">
                        @php $freq = $machinery->maint_freq; @endphp
                        <option value="Diario" {{ $freq=='Diario'?'selected':'' }}>Diario</option>
                        <option value="Semanal" {{ $freq=='Semanal'?'selected':'' }}>Semanal</option>
                        <option value="Quincenal" {{ $freq=='Quincenal'?'selected':'' }}>Quincenal</option>
                        <option value="Mensual" {{ $freq=='Mensual'?'selected':'' }}>Mensual</option>
                        <option value="Bimestral" {{ $freq=='Bimestral'?'selected':'' }}>Bimestral</option>
                        <option value="Trimestral" {{ $freq=='Trimestral'?'selected':'' }}>Trimestral</option>
                        <option value="Semestral" {{ $freq=='Semestral'?'selected':'' }}>Semestral</option>
                        <option value="Anual" {{ $freq=='Anual'?'selected':'' }}>Anual</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-soft-gray-200 flex justify-end gap-3">
                <button type="button" id="cancelEditModal" class="px-5 py-2 border border-soft-gray-300 rounded-lg text-soft-gray-700 hover:bg-soft-gray-50">Cancelar</button>
                <button type="submit" class="px-5 py-2 bg-soft-green-600 text-white rounded-lg hover:bg-soft-green-700">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('editModal');
    const openBtn = document.getElementById('openEditModalShow');
    const closeBtn = document.getElementById('closeEditModal');
    const cancelBtn = document.getElementById('cancelEditModal');
    function openModal(){ modal.classList.remove('hidden'); document.body.classList.add('overflow-hidden'); }
    function closeModal(){ modal.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); }
    // Exponer función global para fallback de onclick
    function openEditModal(){ openModal(); }
    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e)=>{ if(e.target===modal) closeModal(); });
    document.getElementById('edit_serial').addEventListener('input', function(){ this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, ''); });
</script>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Datos Generales -->
            <div class="bg-white rounded-xl shadow-lg border border-soft-gray-100 p-8">
                <h2 class="text-xl font-semibold text-soft-gray-800 mb-6 flex items-center">
                    <i class="fas fa-info-circle text-soft-blue-600 mr-3"></i>
                    Información General
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-soft-gray-600 mb-2">Nombre</label>
                        <p class="text-lg font-medium text-soft-gray-900">{{ $machinery->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-soft-gray-600 mb-2">Ubicación</label>
                        <p class="text-lg text-soft-gray-900 flex items-center">
                            <i class="fas fa-map-marker-alt text-soft-red-500 mr-2"></i>
                            {{ $machinery->location }}
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-soft-gray-600 mb-2">Fecha de Inicio</label>
                        <p class="text-lg text-soft-gray-900 flex items-center">
                            <i class="fas fa-calendar-alt text-soft-green-500 mr-2"></i>
                            {{ $machinery->start_func->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-soft-gray-500 mt-1">
                            Hace {{ $machinery->start_func->diffForHumans() }}
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-soft-gray-600 mb-2">Frecuencia de Mantenimiento</label>
                        <p class="text-lg text-soft-gray-900 flex items-center">
                            <i class="fas fa-clock text-soft-purple-500 mr-2"></i>
                            {{ $machinery->maint_freq }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Especificaciones Técnicas -->
            <div class="bg-white rounded-xl shadow-lg border border-soft-gray-100 p-8">
                <h2 class="text-xl font-semibold text-soft-gray-800 mb-6 flex items-center">
                    <i class="fas fa-cogs text-soft-green-600 mr-3"></i>
                    Especificaciones Técnicas
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-soft-gray-600 mb-2">Marca</label>
                        <p class="text-lg font-medium text-soft-gray-900">{{ $machinery->brand }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-soft-gray-600 mb-2">Modelo</label>
                        <p class="text-lg text-soft-gray-900">{{ $machinery->model }}</p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-soft-gray-600 mb-2">Número de Serie</label>
                        <p class="text-lg font-mono text-soft-gray-900 bg-soft-gray-50 px-4 py-2 rounded-lg border">
                            {{ $machinery->serial }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Historial (Placeholder para futuras funcionalidades) -->
            <div class="bg-white rounded-xl shadow-lg border border-soft-gray-100 p-8">
                <h2 class="text-xl font-semibold text-soft-gray-800 mb-6 flex items-center">
                    <i class="fas fa-history text-soft-indigo-600 mr-3"></i>
                    Historial de Actividades
                </h2>
                
                <div class="text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-soft-gray-100 rounded-full mb-4">
                        <i class="fas fa-history text-2xl text-soft-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-soft-gray-900 mb-2">Sin historial disponible</h3>
                    <p class="text-soft-gray-600">El historial de mantenimientos y usos aparecerá aquí.</p>
                </div>
            </div>
        </div>

        <!-- Panel Lateral -->
        <div class="space-y-6">
            <!-- Estado Actual -->
            <div class="bg-white rounded-xl shadow-lg border border-soft-gray-100 p-6">
                <h3 class="text-lg font-semibold text-soft-gray-800 mb-4 flex items-center">
                    <i class="fas fa-heartbeat text-soft-red-500 mr-2"></i>
                    Estado Actual
                </h3>
                
                @php
                    $status = $machinery->status;
                    $statusConfig = match($status) {
                        'Operativa' => [
                            'class' => 'bg-green-100 text-green-800 border-green-200',
                            'icon' => 'fas fa-check-circle text-green-600',
                            'description' => 'La maquinaria está en perfecto estado de funcionamiento.'
                        ],
                        'Mantenimiento requerido' => [
                            'class' => 'bg-red-100 text-red-800 border-red-200',
                            'icon' => 'fas fa-exclamation-triangle text-red-600',
                            'description' => 'Se requiere mantenimiento según la programación establecida.'
                        ],
                        default => [
                            'class' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'icon' => 'fas fa-clock text-yellow-600',
                            'description' => 'Estado de mantenimiento pendiente de verificación.'
                        ]
                    };
                @endphp
                
                <div class="border {{ $statusConfig['class'] }} rounded-lg p-4 mb-4">
                    <div class="flex items-center mb-2">
                        <i class="{{ $statusConfig['icon'] }} mr-2"></i>
                        <span class="font-semibold">{{ $status }}</span>
                    </div>
                    <p class="text-sm">{{ $statusConfig['description'] }}</p>
                </div>
                
                <div class="text-sm text-soft-gray-600">
                    <p><strong>Última actualización:</strong> {{ $machinery->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-white rounded-xl shadow-lg border border-soft-gray-100 p-6">
                <h3 class="text-lg font-semibold text-soft-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-soft-yellow-500 mr-2"></i>
                    Acciones Rápidas
                </h3>
                
                <div class="space-y-3">
                    <button class="w-full flex items-center justify-center px-4 py-3 bg-soft-blue-50 text-soft-blue-700 rounded-lg hover:bg-soft-blue-100 transition-colors border border-soft-blue-200">
                        <i class="fas fa-wrench mr-2"></i>
                        Registrar Mantenimiento
                    </button>
                    
                    <button class="w-full flex items-center justify-center px-4 py-3 bg-soft-green-50 text-soft-green-700 rounded-lg hover:bg-soft-green-100 transition-colors border border-soft-green-200">
                        <i class="fas fa-play mr-2"></i>
                        Registrar Uso
                    </button>
                    
                    <button class="w-full flex items-center justify-center px-4 py-3 bg-soft-purple-50 text-soft-purple-700 rounded-lg hover:bg-soft-purple-100 transition-colors border border-soft-purple-200">
                        <i class="fas fa-file-alt mr-2"></i>
                        Generar Reporte
                    </button>
                </div>
            </div>

            
        </div>
    </div>
</div>
@endsection


