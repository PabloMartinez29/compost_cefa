@extends('layouts.master')

@section('title', 'Registrar Maquinaria')

@section('content')
<div class="min-h-screen bg-soft-gray-50 py-8">
    <!-- Contenedor más ancho -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-soft-green-500 to-soft-green-600 rounded-xl flex items-center justify-center shadow-sm">
                    <i class="fas fa-cogs text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-soft-gray-900">Registro de Maquinaria</h1>
                    <p class="text-soft-gray-600">Registra la información de nueva maquinaria del centro de acopio</p>
                </div>
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

        <!-- Form Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden w-full">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-soft-green-500 to-soft-green-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-edit mr-3"></i>
                    Formulario de Registro
                </h2>
            </div>

            <!-- Form Body -->
            <form action="{{ route('machinery.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Primera fila: Nombre, Ubicación, Fecha -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-soft-gray-700 flex items-center">
                            <i class="fas fa-cogs mr-2 text-soft-green-600"></i>
                            Nombre de la maquinaria
                        </label>
                        <input type="text" name="name" id="name" maxlength="150" required
                               value="{{ old('name') }}"
                               placeholder="Nombre"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-xl focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-all duration-200 bg-soft-gray-50 hover:bg-white">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- location -->
                    <div class="space-y-2">
                        <label for="location" class="block text-sm font-semibold text-soft-gray-700 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-soft-green-600"></i>
                            Ubicación
                        </label>
                        <input type="text" name="location" id="location" maxlength="150" required
                               value="{{ old('location') }}"
                               placeholder="Ej: Galpón A - Sector 1"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-xl focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-all duration-200 bg-soft-gray-50 hover:bg-white">
                        @error('location')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- start_func -->
                    <div class="space-y-2">
                        <label for="start_func" class="block text-sm font-semibold text-soft-gray-700 flex items-center">
                            <i class="fas fa-calendar-alt mr-2 text-soft-green-600"></i>
                            Fecha de inicio de funcionamiento
                        </label>
                        <input type="date" name="start_func" id="start_func" required
                               value="{{ old('start_func') }}"
                               max="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-xl focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-all duration-200 bg-soft-gray-50 hover:bg-white">
                        @error('start_func')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Segunda fila: brand, model -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- brand -->
                    <div class="space-y-2">
                        <label for="brand" class="block text-sm font-semibold text-soft-gray-700 flex items-center">
                            <i class="fas fa-industry mr-2 text-soft-green-600"></i>
                            Marca
                        </label>
                        <input type="text" name="brand" id="brand" maxlength="100" required
                               value="{{ old('brand') }}"
                               placeholder="Ej: jcb"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-xl focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-all duration-200 bg-soft-gray-50 hover:bg-white">
                        @error('brand')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- model -->
                    <div class="space-y-2">
                        <label for="model" class="block text-sm font-semibold text-soft-gray-700 flex items-center">
                            <i class="fas fa-tag mr-2 text-soft-green-600"></i>
                            Modelo
                        </label>
                        <input type="text" name="model" id="model" maxlength="100" required
                               value="{{ old('model') }}"
                               placeholder="Ej: 5075E"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-xl focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-all duration-200 bg-soft-gray-50 hover:bg-white">
                        @error('model')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tercera fila: serial, maint_freq -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- serial -->
                    <div class="space-y-2">
                        <label for="serial" class="block text-sm font-semibold text-soft-gray-700 flex items-center">
                            <i class="fas fa-barcode mr-2 text-soft-green-600"></i>
                            Número de serie
                        </label>
                        <input type="text" name="serial" id="serial" maxlength="100" required
                               value="{{ old('serial') }}"
                               placeholder="Ej: JD5075E2023001"
                               class="w-full px-4 py-3 border border-soft-gray-300 rounded-xl focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-all duration-200 bg-soft-gray-50 hover:bg-white font-mono">
                        @error('serial')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- maint_freq -->
                    <div class="space-y-2">
                        <label for="maint_freq" class="block text-sm font-semibold text-soft-gray-700 flex items-center">
                            <i class="fas fa-wrench mr-2 text-soft-green-600"></i>
                            Frecuencia de mantenimiento
                        </label>
                        <select name="maint_freq" id="maint_freq" required
                                class="w-full px-4 py-3 border border-soft-gray-300 rounded-xl focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 transition-all duration-200 bg-soft-gray-50 hover:bg-white">
                            <option value="">Seleccionar frecuencia...</option>
                            <option value="Diario" {{ old('maint_freq') == 'Diario' ? 'selected' : '' }}>Diario</option>
                            <option value="Semanal" {{ old('maint_freq') == 'Semanal' ? 'selected' : '' }}>Semanal</option>
                            <option value="Quincenal" {{ old('maint_freq') == 'Quincenal' ? 'selected' : '' }}>Quincenal</option>
                            <option value="Mensual" {{ old('maint_freq') == 'Mensual' ? 'selected' : '' }}>Mensual</option>
                            <option value="Bimestral" {{ old('maint_freq') == 'Bimestral' ? 'selected' : '' }}>Bimestral</option>
                            <option value="Trimestral" {{ old('maint_freq') == 'Trimestral' ? 'selected' : '' }}>Trimestral</option>
                            <option value="Semestral" {{ old('maint_freq') == 'Semestral' ? 'selected' : '' }}>Semestral</option>
                            <option value="Anual" {{ old('maint_freq') == 'Anual' ? 'selected' : '' }}>Anual</option>
                        </select>
                        @error('maint_freq')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-soft-gray-200 justify-center">
                    <button type="button" onclick="window.history.back()"
                            class="px-6 py-2.5 border border-soft-gray-300 text-soft-gray-700 rounded-xl hover:bg-soft-gray-50 transition-all duration-200 font-medium flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-soft-green-500 to-soft-green-600 text-white rounded-xl hover:from-soft-green-600 hover:to-soft-green-700 transition-all duration-200 font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Registrar Maquinaria
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Validación en tiempo real del número de serie
    document.addEventListener('DOMContentLoaded', function() {
        const serialInput = document.getElementById('serial');
        
        if (serialInput) {
            serialInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            });
        }
        
        // Confirmación antes de enviar el formulario
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
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
                
                return confirm('¿Estás seguro de que deseas registrar esta maquinaria con los datos ingresados?');
            });
        }
    });
</script>
@endsection
