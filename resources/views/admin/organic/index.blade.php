@extends('layouts.master')

@section('content')
@vite(['resources/css/waste.css'])

<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="waste-header animate-fade-in-up">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="waste-title">
                    <i class="fas fa-recycle waste-icon"></i>
                    Gestión de Residuos Orgánicos
                </h1>
                <p class="waste-subtitle">
                    <i class="fas fa-user-shield text-green-400 mr-2"></i>
                    {{ Auth::user()->name }} - Admin Panel
                </p>
            </div>
            <div class="text-right">
                <div class="text-green-400 font-bold text-lg">{{ \Carbon\Carbon::now()->setTimezone('America/Bogota')->format('d/m/Y') }}</div>    
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Weight -->
        <div class="waste-card waste-card-primary animate-fade-in-up animate-delay-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-600 uppercase tracking-wide">Peso Total</div>
                    <div class="text-3xl font-bold text-gray-800">{{ number_format($totalWeight, 2) }} Kg</div>
                </div>
                <div class="waste-card-icon text-blue-600">
                    <i class="fas fa-weight"></i>
                </div>
            </div>
        </div>

        <!-- Total Records -->
        <div class="waste-card waste-card-success animate-fade-in-up animate-delay-2">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Registros</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalRecords }}</div>
                </div>
                <div class="waste-card-icon text-green-600">
                    <i class="fas fa-list"></i>
                </div>
            </div>
        </div>

        <!-- Today Records -->
        <div class="waste-card waste-card-warning animate-fade-in-up animate-delay-3">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-600 uppercase tracking-wide">Registros Hoy</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $todayRecords }}</div>
                </div>
                <div class="waste-card-icon text-yellow-600">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </div>
        </div>

        <!-- Today Weight -->
        <div class="waste-card waste-card-info animate-fade-in-up animate-delay-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-600 uppercase tracking-wide">Peso Hoy</div>
                    <div class="text-3xl font-bold text-gray-800">{{ number_format($todayWeight, 2) }} Kg</div>
                </div>
                <div class="waste-card-icon text-cyan-600">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="waste-container animate-fade-in-up animate-delay-2">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-table text-green-600 mr-2"></i>
                Registros de Residuos Orgánicos
            </h2>
            <a href="{{ route('admin.organic.create') }}" class="bg-green-400 text-green-800 border border-green-500 hover:bg-green-500 px-4 py-2 rounded-lg transition-all duration-200 flex items-center shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Nuevo Registro
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="waste-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Peso (Kg)</th>
                        <th>Entregado Por</th>
                        <th>Recibido Por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organics as $organic)
                        <tr>
                            <td class="font-mono">#{{ str_pad($organic->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $organic->formatted_date }}</td>
                            <td>
                                <span class="waste-badge 
                                    @if($organic->type == 'Kitchen') waste-badge-success
                                    @elseif($organic->type == 'Beds') waste-badge-info
                                    @elseif($organic->type == 'Leaves') waste-badge-warning
                                    @else waste-badge-primary
                                    @endif">
                                    {{ $organic->type_in_spanish }}
                                </span>
                            </td>
                            <td class="font-semibold">{{ $organic->formatted_weight }}</td>
                            <td>{{ $organic->delivered_by }}</td>
                            <td>{{ $organic->received_by }}</td>
                            <td>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.organic.show', $organic) }}" 
                                       class="text-blue-500 hover:text-blue-700" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.organic.edit', $organic) }}" 
                                       class="text-green-500 hover:text-green-700" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.organic.destroy', $organic) }}" 
                                          method="POST" class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4 block"></i>
                                No se encontraron registros de residuos orgánicos
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($organics->hasPages())
            <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                <div class="text-sm text-gray-700">
                    Showing {{ $organics->firstItem() }} to {{ $organics->lastItem() }} of {{ $organics->total() }} results
                </div>
                <div class="flex space-x-2">
                    {{ $organics->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal para Crear Registro -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Registrar Residuo Orgánico</h3>
                    <p class="text-sm text-gray-600">{{ Auth::user()->name }} - Nuevo registro</p>
                </div>
            </div>
            <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="py-6">
            <form id="createForm" action="{{ route('admin.organic.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Fecha -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-green-500 mr-2"></i>
                            Fecha *
                        </label>
                        <input type="date" name="date" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('date') border-red-500 @enderror" 
                               value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo de Residuo -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-recycle text-green-500 mr-2"></i>
                            Tipo de Residuo *
                        </label>
                        <select name="type" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('type') border-red-500 @enderror" 
                                required>
                            <option value="">Seleccionar tipo de residuo</option>
                            <option value="Kitchen" {{ old('type') == 'Kitchen' ? 'selected' : '' }}>🍽️ Cocina</option>
                            <option value="Beds" {{ old('type') == 'Beds' ? 'selected' : '' }}>🛏️ Camas</option>
                            <option value="Leaves" {{ old('type') == 'Leaves' ? 'selected' : '' }}>🍃 Hojas</option>
                            <option value="CowDung" {{ old('type') == 'CowDung' ? 'selected' : '' }}>🐄 Estiércol de Vaca</option>
                            <option value="ChickenManure" {{ old('type') == 'ChickenManure' ? 'selected' : '' }}>🐔 Estiércol de Pollo</option>
                            <option value="PigManure" {{ old('type') == 'PigManure' ? 'selected' : '' }}>🐷 Estiércol de Cerdo</option>
                            <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>📦 Otro</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Peso -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-weight text-green-500 mr-2"></i>
                            Peso (Kg) *
                        </label>
                        <input type="number" name="weight" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('weight') border-red-500 @enderror" 
                               placeholder="0.00" step="0.01" min="0.01" 
                               value="{{ old('weight') }}" required>
                        @error('weight')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Entregado Por -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user text-green-500 mr-2"></i>
                            Entregado Por *
                        </label>
                        <input type="text" name="delivered_by" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('delivered_by') border-red-500 @enderror" 
                               placeholder="Nombre del entregador" 
                               value="{{ old('delivered_by') }}" required>
                        @error('delivered_by')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Recibido Por -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user-check text-green-500 mr-2"></i>
                            Recibido Por *
                        </label>
                        <input type="text" name="received_by" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('received_by') border-red-500 @enderror" 
                               placeholder="Nombre del receptor" 
                               value="{{ old('received_by', Auth::user()->name) }}" required>
                        @error('received_by')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Imagen -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-image text-green-500 mr-2"></i>
                            Imagen (Opcional)
                        </label>
                        <div class="relative">
                            <input type="file" name="img" id="imageInput" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('img') border-red-500 @enderror" 
                                   accept="image/*" onchange="previewImage(this)">
                            <div id="imagePreview" class="mt-3 hidden">
                                <img id="previewImg" class="w-32 h-32 object-cover rounded-lg border border-gray-200" alt="Preview">
                            </div>
                        </div>
                        @error('img')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">Tamaño máximo: 2MB. Formatos: JPEG, PNG, JPG, GIF</p>
                    </div>

                    <!-- Notas -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-sticky-note text-green-500 mr-2"></i>
                            Notas
                        </label>
                        <textarea name="notes" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 resize-none @error('notes') border-red-500 @enderror" 
                                  rows="4" placeholder="Ingrese notas adicionales sobre el residuo orgánico...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
            <button onclick="closeCreateModal()" 
                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                <i class="fas fa-times mr-2"></i>
                Cancelar
            </button>
            <button onclick="submitForm()" 
                    class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-lg">
                <i class="fas fa-save mr-2"></i>
                Guardar Registro
            </button>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Limpiar formulario
    document.getElementById('createForm').reset();
    document.getElementById('imagePreview').classList.add('hidden');
}

function submitForm() {
    document.getElementById('createForm').submit();
}

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
    }
}

// Cerrar modal al hacer clic fuera
document.getElementById('createModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateModal();
    }
});

// Cerrar modal con tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCreateModal();
    }
});
</script>
@endsection
