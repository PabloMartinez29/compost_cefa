@extends('layouts.master')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-soft-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-soft-gray-800 flex items-center">
                    <i class="fas fa-history text-soft-green-600 mr-3"></i>
                    Historial de Notificaciones
                </h1>
                <p class="text-soft-gray-600 mt-1">
                    Todas las solicitudes de permisos recibidas
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
                    <i class="fas fa-bell text-blue-600 text-xl"></i>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Aprendiz</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Registro</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Procesado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-soft-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-soft-gray-200">
                    @forelse($notifications as $notification)
                        <tr class="hover:bg-soft-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-soft-gray-900">
                                {{ $notification->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user-graduate text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-soft-gray-900">{{ $notification->fromUser->name }}</div>
                                        <div class="text-sm text-soft-gray-500">{{ $notification->fromUser->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-soft-gray-900">
                                    #{{ str_pad($notification->organic_id, 3, '0', STR_PAD_LEFT) }}
                                </div>
                                @if($notification->organic)
                                    <div class="text-sm text-soft-gray-500">
                                        {{ $notification->organic->type_in_spanish }} - {{ $notification->organic->formatted_weight }}
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
                                    {{ $notification->updated_at->diffForHumans() }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($notification->status === 'pending')
                                    <div class="flex space-x-2">
                                        <button onclick="approveDeleteRequest({{ $notification->id }})" 
                                            class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="rejectDeleteRequest({{ $notification->id }})" 
                                            class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @else
                                    <span class="text-soft-gray-400">Procesada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-bell-slash text-soft-gray-400 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-soft-gray-900 mb-2">No hay notificaciones</h3>
                                    <p class="text-soft-gray-500">Aún no has recibido solicitudes de permisos.</p>
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

<script>
    function approveDeleteRequest(notificationId) {
        fetch(`/admin/notifications/${notificationId}/approve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: '¡Aprobado!',
                    text: 'Solicitud de eliminación aprobada exitosamente',
                    icon: 'success',
                    confirmButtonColor: '#22c55e'
                }).then(() => {
                    location.reload();
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al procesar la solicitud',
                icon: 'error'
            });
        });
    }

    function rejectDeleteRequest(notificationId) {
        fetch(`/admin/notifications/${notificationId}/reject`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Rechazado',
                    text: 'Solicitud de eliminación rechazada',
                    icon: 'info',
                    confirmButtonColor: '#6b7280'
                }).then(() => {
                    location.reload();
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al procesar la solicitud',
                icon: 'error'
            });
        });
    }
</script>
@endsection
