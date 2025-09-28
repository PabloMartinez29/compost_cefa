@extends('layouts.master')

@section('title', 'Gestión de Maquinaria')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-soft-gray-800 mb-2">
                <i class="fas fa-cogs text-soft-green-600 mr-3"></i>
                Gestión de Maquinaria
            </h1>
            <p class="text-soft-gray-600">Administra y controla toda la maquinaria del centro de acopio</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('machinery.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-soft-green-600 to-soft-green-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <i class="fas fa-plus mr-2"></i>
                Registrar Maquinaria
            </a>
        </div>
    </div>

    <!-- Mensajes de estado -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-green-700">{{ session('success') }}</p>
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

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 border border-soft-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-cogs text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-soft-gray-600">Total Maquinarias</p>
                    <p class="text-2xl font-bold text-soft-gray-900">{{ $machineries->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 border border-soft-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-soft-gray-600">Operativas</p>
                    <p class="text-2xl font-bold text-soft-gray-900">
                        {{ $machineries->where('status', 'Operativa')->count() }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 border border-soft-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-wrench text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-soft-gray-600">Mantenimiento</p>
                    <p class="text-2xl font-bold text-soft-gray-900">
                        {{ $machineries->where('status', '!=', 'Operativa')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de maquinaria -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-soft-gray-100">
        @if($machineries->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-soft-gray-200">
                    <thead class="bg-soft-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-soft-gray-600 uppercase tracking-wider">
                                Maquinaria
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-soft-gray-600 uppercase tracking-wider">
                                Ubicación
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-soft-gray-600 uppercase tracking-wider">
                                Marca/Modelo
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-soft-gray-600 uppercase tracking-wider">
                                Serie
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-soft-gray-600 uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-soft-gray-600 uppercase tracking-wider">
                                Mantenimiento
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-soft-gray-600 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-soft-gray-200">
                        @foreach($machineries as $machinery)
                            <tr class="hover:bg-soft-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-soft-green-100 rounded-lg mr-3">
                                            <i class="fas fa-cogs text-soft-green-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-soft-gray-900">
                                                {{ $machinery->name }}
                                            </div>
                                            <div class="text-sm text-soft-gray-500">
                                                Desde {{ $machinery->start_func->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-soft-gray-900">{{ $machinery->location }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-soft-gray-900">{{ $machinery->brand }}</div>
                                    <div class="text-sm text-soft-gray-500">{{ $machinery->model }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-mono text-soft-gray-900">{{ $machinery->serial }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = $machinery->status;
                                        $statusClass = match($status) {
                                            'Operativa' => 'bg-green-100 text-green-800',
                                            'Mantenimiento requerido' => 'bg-red-100 text-red-800',
                                            default => 'bg-yellow-100 text-yellow-800'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-soft-gray-900">{{ $machinery->maint_freq }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('machinery.show', $machinery) }}" 
                                           class="text-soft-blue-600 hover:text-soft-blue-900 p-2 rounded-lg hover:bg-soft-blue-50 transition-colors"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button"
                                                class="text-soft-yellow-600 hover:text-soft-yellow-900 p-2 rounded-lg hover:bg-soft-yellow-50 transition-colors open-edit-modal"
                                                title="Editar"
                                                data-id="{{ $machinery->id }}"
                                                data-name="{{ $machinery->name }}"
                                                data-location="{{ $machinery->location }}"
                                                data-brand="{{ $machinery->brand }}"
                                                data-model="{{ $machinery->model }}"
                                                data-serial="{{ $machinery->serial }}"
                                                data-start_func="{{ $machinery->start_func->format('Y-m-d') }}"
                                                data-maint_freq="{{ $machinery->maint_freq }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('machinery.destroy', $machinery) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta maquinaria?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                                    title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($machineries->hasPages())
                <div class="px-6 py-4 border-t border-soft-gray-200">
                    {{ $machineries->links() }}
                </div>
            @endif
        @else
            <!-- Estado vacío -->
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-soft-gray-100 rounded-full mb-4">
                    <i class="fas fa-cogs text-2xl text-soft-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-soft-gray-900 mb-2">No hay maquinaria registrada</h3>
                <p class="text-soft-gray-600 mb-6">Comienza registrando tu primera maquinaria en el sistema.</p>
                <a href="{{ route('machinery.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-soft-green-600 text-white font-medium rounded-lg hover:bg-soft-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Registrar Primera Maquinaria
                </a>
            </div>
        @endif
    </div>
</div>
<!-- Modal de edición -->
<div id="editModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative max-w-3xl w-full mx-auto mt-20 bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-soft-green-600 to-soft-green-700 px-6 py-4 flex items-center justify-between">
            <h3 class="text-white font-semibold"><i class="fas fa-edit mr-2"></i>Editar Maquinaria</h3>
            <button id="closeEditModal" class="text-white hover:text-soft-gray-200"><i class="fas fa-times"></i></button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="edit_name" class="block text-sm font-medium text-soft-gray-700 mb-2">Nombre de la maquinaria</label>
                    <input id="edit_name" name="name" type="text" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_location" class="block text-sm font-medium text-soft-gray-700 mb-2">Ubicación</label>
                    <input id="edit_location" name="location" type="text" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_start_func" class="block text-sm font-medium text-soft-gray-700 mb-2">Fecha de inicio de funcionamiento</label>
                    <input id="edit_start_func" name="start_func" type="date" max="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_brand" class="block text-sm font-medium text-soft-gray-700 mb-2">Marca</label>
                    <input id="edit_brand" name="brand" type="text" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_model" class="block text-sm font-medium text-soft-gray-700 mb-2">Modelo</label>
                    <input id="edit_model" name="model" type="text" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500" />
                </div>
                <div>
                    <label for="edit_serial" class="block text-sm font-medium text-soft-gray-700 mb-2">Número de serie</label>
                    <input id="edit_serial" name="serial" type="text" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500 font-mono" />
                </div>
                <div class="md:col-span-2">
                    <label for="edit_maint_freq" class="block text-sm font-medium text-soft-gray-700 mb-2">Frecuencia de mantenimiento</label>
                    <select id="edit_maint_freq" name="maint_freq" required class="w-full px-4 py-3 border border-soft-gray-300 rounded-lg focus:ring-2 focus:ring-soft-green-500 focus:border-soft-green-500">
                        <option value="Diario">Diario</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Quincenal">Quincenal</option>
                        <option value="Mensual">Mensual</option>
                        <option value="Bimestral">Bimestral</option>
                        <option value="Trimestral">Trimestral</option>
                        <option value="Semestral">Semestral</option>
                        <option value="Anual">Anual</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-soft-gray-200 flex justify-end gap-3">
                <button type="button" id="cancelEditModal" class="px-5 py-2 border border-soft-gray-300 rounded-lg text-soft-gray-700 hover:bg-soft-gray-50">Cancelar</button>
                <button type="submit" class="px-5 py-2 bg-soft-green-600 text-white rounded-lg hover:bg-soft-green-700">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('editModal');
    const closeBtn = document.getElementById('closeEditModal');
    const cancelBtn = document.getElementById('cancelEditModal');
    const form = document.getElementById('editForm');

    function openModal() { modal.classList.remove('hidden'); document.body.classList.add('overflow-hidden'); }
    function closeModal() { modal.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); }

    document.querySelectorAll('.open-edit-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            form.action = `{{ url('machinery') }}/${id}`;
            document.getElementById('edit_name').value = btn.dataset.name;
            document.getElementById('edit_location').value = btn.dataset.location;
            document.getElementById('edit_brand').value = btn.dataset.brand;
            document.getElementById('edit_model').value = btn.dataset.model;
            document.getElementById('edit_serial').value = btn.dataset.serial;
            document.getElementById('edit_start_func').value = btn.dataset.start_func;
            document.getElementById('edit_maint_freq').value = btn.dataset.maint_freq;
            openModal();
        });
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

    // Validar número de serie en tiempo real
    document.getElementById('edit_serial').addEventListener('input', function(){
        this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
    });
</script>
@endsection


