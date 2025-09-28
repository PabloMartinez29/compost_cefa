@extends('layouts.masteraprendiz')

@section('content')
<div class="min-h-screen bg-soft-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-soft-green-500 to-soft-green-600 rounded-xl flex items-center justify-center shadow-sm">
                    <i class="fas fa-warehouse text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-soft-gray-900">Bodega de Clasificación</h1>
                    <p class="text-soft-gray-600">Inventario general de residuos orgánicos</p>
                </div>
            </div>
        </div>

        <!-- Total Inventory Summary -->
        @php
            $totalInventory = array_sum($inventory);
        @endphp
        <div class="bg-gradient-to-r from-soft-green-100 to-soft-green-200 rounded-2xl p-6 mb-8 border border-soft-green-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-soft-gray-900">Inventario Total</h2>
                    <p class="text-soft-gray-600">Residuos orgánicos clasificados</p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold text-soft-green-700">
                        {{ number_format($totalInventory, 1) }} kg
                    </div>
                    <div class="text-sm text-soft-gray-600">Total en bodega</div>
                </div>
            </div>
        </div>

        <!-- Inventory Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @php
                $types = [
                    'Kitchen' => ['name' => 'Cocina', 'icon' => 'fa-utensils', 'color' => 'from-orange-200 to-orange-300', 'border' => 'border-orange-200'],
                    'Beds' => ['name' => 'Camas', 'icon' => 'fa-bed', 'color' => 'from-blue-200 to-blue-300', 'border' => 'border-blue-200'],
                    'Leaves' => ['name' => 'Hojas', 'icon' => 'fa-leaf', 'color' => 'from-green-200 to-green-300', 'border' => 'border-green-200'],
                    'CowDung' => ['name' => 'Estiércol de Vaca', 'icon' => 'fa-cow', 'color' => 'from-yellow-200 to-yellow-300', 'border' => 'border-yellow-200'],
                    'ChickenManure' => ['name' => 'Estiércol de Pollo', 'icon' => 'fa-egg', 'color' => 'from-red-200 to-red-300', 'border' => 'border-red-200'],
                    'PigManure' => ['name' => 'Estiércol de Cerdo', 'icon' => 'fa-piggy-bank', 'color' => 'from-pink-200 to-pink-300', 'border' => 'border-pink-200'],
                    'Other' => ['name' => 'Otros', 'icon' => 'fa-box', 'color' => 'from-gray-200 to-gray-300', 'border' => 'border-gray-200']
                ];
            @endphp

            @foreach($types as $type => $info)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 {{ $info['border'] }}">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br {{ $info['color'] }} rounded-xl flex items-center justify-center">
                                <i class="fas {{ $info['icon'] }} text-gray-600 text-lg"></i>
                            </div>
                            <span class="text-2xl font-bold text-soft-gray-900">
                                {{ number_format($inventory[$type] ?? 0, 1) }} kg
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold text-soft-gray-900 mb-2">{{ $info['name'] }}</h3>
                        <a href="{{ route('aprendiz.warehouse.inventory', $type) }}" 
                           class="text-soft-green-600 hover:text-soft-green-700 font-medium text-sm flex items-center">
                            Ver detalles
                            <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Recent Movements -->
        <div class="bg-white rounded-2xl shadow-lg">
            <div class="px-6 py-4 border-b border-soft-gray-200">
                <h2 class="text-xl font-semibold text-soft-gray-900 flex items-center">
                    <i class="fas fa-history mr-3 text-soft-green-600"></i>
                    Movimientos Recientes
                </h2>
            </div>
            <div class="p-6">
                @if($recentMovements->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b border-soft-gray-200">
                                    <th class="pb-3 text-sm font-semibold text-soft-gray-700">Fecha</th>
                                    <th class="pb-3 text-sm font-semibold text-soft-gray-700">Tipo</th>
                                    <th class="pb-3 text-sm font-semibold text-soft-gray-700">Movimiento</th>
                                    <th class="pb-3 text-sm font-semibold text-soft-gray-700">Peso</th>
                                    <th class="pb-3 text-sm font-semibold text-soft-gray-700">Procesado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentMovements as $movement)
                                    <tr class="border-b border-soft-gray-100">
                                        <td class="py-4 text-sm text-soft-gray-900">{{ $movement->formatted_date }}</td>
                                        <td class="py-4 text-sm text-soft-gray-900">{{ $movement->type_in_spanish }}</td>
                                        <td class="py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $movement->movement_type === 'entry' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $movement->movement_type_in_spanish }}
                                            </span>
                                        </td>
                                        <td class="py-4 text-sm text-soft-gray-900">{{ $movement->formatted_weight }}</td>
                                        <td class="py-4 text-sm text-soft-gray-900">{{ $movement->processed_by }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-warehouse text-soft-gray-300 text-4xl mb-4"></i>
                        <p class="text-soft-gray-500">No hay movimientos registrados</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
