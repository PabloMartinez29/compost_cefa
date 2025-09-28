@extends('layouts.master')

@section('title', 'Editar Maquinaria')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center mb-8">
        <a href="{{ route('machinery.show', $machinery) }}" 
           class="mr-4 p-2 text-soft-gray-600 hover:text-soft-green-600 rounded-lg hover:bg-soft-green-50 transition-colors">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-soft-gray-800 mb-2">
                <i class="fas fa-edit text-soft-yellow-600 mr-3"></i>
                Editar Maquinaria
            </h1>
            <p class="text-soft-gray-600">Modifica los datos de: <strong>{{ $machinery->name }}</strong></p>
        </div>
    </div>

    <!-- Mensajes de error -->
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Por favor corrige los siguientes errores:</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Formulario -->
    <div class="bg-white rounded-xl shadow-lg border border-soft-gray-100">
        <form action="{{ route('machinery.update', $machinery) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Información General -->
                <div class="space-y-6">
                    <div class="border-b border-soft-gray-200 pb-4">
                        <h3 class="text-lg font-semibold text-soft-gray-800 flex items-center">
                            <i class="fas fa-info-circle text-soft-blue-600 mr-2"></i>
                            Información General
                        </h3>
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-soft-gray-700 mb-2">
                            Nombre de la maquinaria *
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $machinery->name) }}"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-colors @error('name') border-red-300 @enderror"
                               placeholder="Ej: Tractor"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ubicación -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-soft-gray-700 mb-2">
                            Ubicación *
                        </label>
                        <input type="text" 
                               id="location" 
                               name="location" 
                               value="{{ old('location', $machinery->location) }}"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-colors @error('location') border-red-300 @enderror"
                               placeholder="Ej: Galpón A - Sector 1"
                               required>
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de inicio de funcionamiento -->
                    <div>
                        <label for="start_func" class="block text-sm font-medium text-soft-gray-700 mb-2">
                            Fecha de inicio de funcionamiento *
                        </label>
                        <input type="date" 
                               id="start_func" 
                               name="start_func" 
                               value="{{ old('start_func', $machinery->start_func->format('Y-m-d')) }}"
                               max="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-colors @error('start_func') border-red-300 @enderror"
                               required>
                        @error('start_func')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Especificaciones Técnicas -->
                <div class="space-y-6">
                    <div class="border-b border-soft-gray-200 pb-4">
                        <h3 class="text-lg font-semibold text-soft-gray-800 flex items-center">
                            <i class="fas fa-cogs text-soft-green-600 mr-2"></i>
                            Especificaciones Técnicas
                        </h3>
                    </div>

                    <!-- Marca -->
                    <div>
                        <label for="brand" class="block text-sm font-medium text-soft-gray-700 mb-2">
                            Marca *
                        </label>
                        <input type="text" 
                               id="brand" 
                               name="brand" 
                               value="{{ old('brand', $machinery->brand) }}"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-colors @error('brand') border-red-300 @enderror"
                               placeholder="Ej: John Deere"
                               required>
                        @error('brand')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Modelo -->
                    <div>
                        <label for="model" class="block text-sm font-medium text-soft-gray-700 mb-2">
                            Modelo *
                        </label>
                        <input type="text" 
                               id="model" 
                               name="model" 
                               value="{{ old('model', $machinery->model) }}"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-colors @error('model') border-red-300 @enderror"
                               placeholder="Ej: 5075E"
                               required>
                        @error('model')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Número de serie -->
                    <div>
                        <label for="serial" class="block text-sm font-medium text-soft-gray-700 mb-2">
                            Número de serie *
                        </label>
                        <input type="text" 
                               id="serial" 
                               name="serial" 
                               value="{{ old('serial', $machinery->serial) }}"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-colors font-mono @error('serial') border-red-300 @enderror"
                               placeholder="Ej: JD5075E2023001"
                               required>
                        @error('serial')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-soft-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            El número de serie debe ser único en el sistema
                        </p>
                    </div>

                    <!-- Frecuencia de mantenimiento -->
                    <div>
                        <label for="maint_freq" class="block text-sm font-medium text-soft-gray-700 mb-2">
                            Frecuencia de mantenimiento *
                        </label>
                        <select id="maint_freq" 
                                name="maint_freq" 
                                class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-colors @error('maint_freq') border-red-300 @enderror"
                                required>
                            <option value="">Seleccionar frecuencia</option>
                            <option value="Diario" {{ old('maint_freq', $machinery->maint_freq) == 'Diario' ? 'selected' : '' }}>Diario</option>
                            <option value="Semanal" {{ old('maint_freq', $machinery->maint_freq) == 'Semanal' ? 'selected' : '' }}>Semanal</option>
                            <option value="Quincenal" {{ old('maint_freq', $machinery->maint_freq) == 'Quincenal' ? 'selected' : '' }}>Quincenal</option>
                            <option value="Mensual" {{ old('maint_freq', $machinery->maint_freq) == 'Mensual' ? 'selected' : '' }}>Mensual</option>
                            <option value="Bimestral" {{ old('maint_freq', $machinery->maint_freq) == 'Bimestral' ? 'selected' : '' }}>Bimestral</option>
                            <option value="Trimestral" {{ old('maint_freq', $machinery->maint_freq) == 'Trimestral' ? 'selected' : '' }}>Trimestral</option>
                            <option value="Semestral" {{ old('maint_freq', $machinery->maint_freq) == 'Semestral' ? 'selected' : '' }}>Semestral</option>
                            <option value="Anual" {{ old('maint_freq', $machinery->maint_freq) == 'Anual' ? 'selected' : '' }}>Anual</option>
                        </select>
                        @error('maint_freq')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Información de auditoría -->
            <div class="mt-8 pt-6 border-t border-soft-gray-200">
                <div class="bg-soft-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-soft-gray-700 mb-2">Información del Registro</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-soft-gray-600">
                        <div>
                            <span class="font-medium">Registrado:</span> {{ $machinery->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">Última modificación:</span> {{ $machinery->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 mt-8 pt-6 border-t border-soft-gray-200">
                <a href="{{ route('machinery.show', $machinery) }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-soft-gray-300 text-soft-gray-700 font-medium rounded-lg hover:bg-soft-gray-50 focus:outline-none focus:ring-2 focus:ring-soft-gray-500 transition-colors">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-soft-yellow-600 to-soft-yellow-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-soft-yellow-500 transition-all duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Actualizar Maquinaria
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Validación en tiempo real del número de serie
document.getElementById('serial').addEventListener('input', function() {
    this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
});

// Confirmación antes de enviar el formulario
document.querySelector('form').addEventListener('submit', function(e) {
    const requiredFields = ['name', 'location', 'brand', 'model', 'serial', 'start_func', 'maint_freq'];
    const emptyFields = [];
    
    requiredFields.forEach(field => {
        const input = document.getElementById(field);
        if (!input.value.trim()) {
            emptyFields.push(field);
        }
    });
    
    if (emptyFields.length > 0) {
        e.preventDefault();
        alert('Por favor completa todos los campos requeridos antes de continuar.');
        return false;
    }
    
    return confirm('¿Estás seguro de que deseas actualizar esta maquinaria con los cambios realizados?');
});
</script>
@endsection


