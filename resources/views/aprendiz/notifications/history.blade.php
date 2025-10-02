@extends('layouts.masteraprendiz')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-soft-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-soft-gray-800 flex items-center">
                    <i class="fas fa-history text-soft-green-600 mr-3"></i>
                    Historial de Mis Solicitudes
                </h1>
                <p class="text-soft-gray-600 mt-1">
                    Todas las solicitudes de permisos que has enviado
                </p>
            </div>
            <div class="text-right">
                <div class="text-soft-green-600 font-bold text-lg">{{ \Carbon\Carbon::now()->setTimezone('America/Bogota')->format('d/m/Y') }}</div>    
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Notifications -->
        <div class="bg-white rounded-lg shadow-sm border border-soft-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-soft-gray-600">Total</p>
                    <p class="text-2xl font-bold text-soft-gray-800">{{ $notifications->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-paper-plane text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-lg shadow-sm border border-soft-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-soft-gray-600">Pendientes</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $notifications->where('status', 'pending')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="bg-white rounded-lg shadow-sm border border-soft-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-soft-gray-600">Aprobadas</p>
                    <p class="text-2xl font-bold text-green-600">{{ $notifications->where('status', 'approved')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="bg-white rounded-lg shadow-sm border border-soft-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-soft-gray-600">Rechazadas</p>
                    <p class="text-2xl font-bold text-red-600">{{ $notifications->where('status', 'rejected')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-times text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Table -->
    <div class="bg-white rounded-lg shadow-sm border border-soft-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-soft-gray-200">
            <h3 class="text-lg font-semibold text-soft-gray-800">Historial Completo</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-soft-gray-200">
                <thead class="bg-soft-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Fecha Solicitud</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Registro</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Respuesta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Leída</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-soft-gray-200">
                    @forelse($notifications as $notification)
                        <tr class="hover:bg-soft-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-soft-gray-900">
                                {{ $notification->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-soft-gray-900">
                                    #{{ str_pad($notification->organic_id, 3, '0', STR_PAD_LEFT) }}
                                </div>
                                @if($notification->organic)
                                    <div class="text-sm text-soft-gray-500">
                                        {{ $notification->organic->type_in_spanish }} - {{ $notification->organic->formatted_weight }}
                                    </div>
                                @else
                                    <div class="text-sm text-red-500">
                                        Registro eliminado
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($notification->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-hourglass-half mr-1"></i>
                                        Pendiente
                                    </span>
                                @elseif($notification->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>
                                        Aprobada
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i>
                                        Rechazada
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-soft-gray-500">
                                @if($notification->status !== 'pending')
                                    {{ $notification->updated_at->format('d/m/Y H:i') }}
                                    <div class="text-xs text-soft-gray-400">
                                        {{ $notification->updated_at->diffForHumans() }}
                                    </div>
                                @else
                                    <span class="text-yellow-600">Esperando respuesta</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($notification->status !== 'pending')
                                    @if($notification->read_at)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-eye mr-1"></i>
                                            Leída
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-eye-slash mr-1"></i>
                                            No leída
                                        </span>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-paper-plane text-soft-gray-400 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-soft-gray-900 mb-2">No hay solicitudes</h3>
                                    <p class="text-soft-gray-500">Aún no has enviado solicitudes de permisos.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
            <div class="px-6 py-4 border-t border-soft-gray-200">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
