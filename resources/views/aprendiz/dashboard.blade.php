@extends('layouts/masteraprendiz')

@section('content')
@vite(['resources/css/dashboard-admin.css'])

<div class="container mx-auto px-6 py-8">
    <!-- Header de Bienvenida -->
    <div class="dashboard-header animate-fade-in-up">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="welcome-title">
                    Bienvenido Aprendiz
                </h1>
                <p class="welcome-subtitle">
                    <i class="fas fa-user text-green-600 mr-2"></i>
                    {{ Auth::user()->name }} - Panel de Aprendiz del Sistema de Compostaje
                </p>
            </div>
            <div class="text-right">
                <div class="text-green-600 font-bold text-lg">{{ \Carbon\Carbon::now()->setTimezone('America/Bogota')->format('d/m/Y') }}</div>    
            </div>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas para Aprendiz -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
        <!-- Mis Actividades -->
        <div class="stats-card stats-card-primary animate-fade-in-up animate-delay-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="stats-label">Mis Actividades</div>
                    <div class="stats-number">0</div>
                </div>
                <div class="stats-icon text-blue-300">
                    <i class="fas fa-tasks"></i>
                </div>
            </div>
        </div>

        <!-- Pilas Asignadas -->
        <div class="stats-card stats-card-success animate-fade-in-up animate-delay-2">
            <div class="flex items-center justify-between">
                <div>
                    <div class="stats-label">Pilas Asignadas</div>
                    <div class="stats-number">0</div>
                </div>
                <div class="stats-icon text-green-300">
                    <i class="fas fa-mountain"></i>
                </div>
            </div>
        </div>

        <!-- Horas de Práctica -->
        <div class="stats-card stats-card-info animate-fade-in-up animate-delay-3">
            <div class="flex items-center justify-between">
                <div>
                    <div class="stats-label">Horas de Práctica</div>
                    <div class="stats-number">0</div>
                </div>
                <div class="stats-icon text-cyan-300">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>

        <!-- Progreso -->
        <div class="stats-card stats-card-warning animate-fade-in-up animate-delay-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="stats-label">Progreso</div>
                    <div class="stats-number">0%</div>
                </div>
                <div class="stats-icon text-yellow-300">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
        <!-- Mis Tareas Asignadas -->
        <div class="info-card animate-fade-in-up animate-delay-2">
            <h2 class="section-title">
                <i class="fas fa-clipboard-list section-icon"></i>
                Mis Tareas Asignadas
            </h2>
            <div class="space-y-4">
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-clipboard-list text-6xl"></i>
                    </div>
                    <p class="text-gray-500 text-lg font-medium">No tienes tareas asignadas</p>
                    <p class="text-gray-400 text-sm">Tu instructor te asignará tareas cuando sea necesario.</p>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="quick-actions animate-fade-in-up animate-delay-3">
            <h2 class="section-title">
                <i class="fas fa-bolt section-icon"></i>
                Acciones Rápidas
            </h2>
            <div class="grid grid-cols-1 gap-4">
                <a href="#" class="action-btn">
                    <i class="fas fa-clipboard-check mr-2"></i>
                    Ver Mis Tareas
                </a>
                <a href="#" class="action-btn-secondary">
                    <i class="fas fa-mountain mr-2"></i>
                    Ver Pilas Asignadas
                </a>
                <a href="#" class="action-btn-info">
                    <i class="fas fa-clock mr-2"></i>
                    Registrar Horas
                </a>
                <a href="#" class="action-btn-warning">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Ver Progreso
                </a>
            </div>
        </div>
    </div>

    <!-- Mensaje de Bienvenida -->
    <div class="mt-8 animate-fade-in-up animate-delay-4">
        <div class="bg-gradient-to-r from-blue-50 via-green-50 to-cyan-50 rounded-lg p-8 border border-green-200">
            <div class="text-center">
                <i class="fas fa-user text-4xl text-green-400 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    ¡Bienvenido al Sistema de Aprendizaje!
                </h3>
                <p class="text-gray-600 mb-4">
                    Comienza tu jornada de aprendizaje en el sistema de compostaje del CEFA. 
                    Completa tus tareas asignadas, registra tus horas de práctica y sigue tu progreso.
                </p>
                <div class="flex justify-center space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                        <i class="fas fa-check-circle mr-1"></i>
                        Listo para Aprender
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-700">
                        <i class="fas fa-clock mr-1"></i>
                        En Espera de Tareas
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection