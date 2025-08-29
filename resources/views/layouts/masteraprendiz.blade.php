<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de Compostaje - Aprendiz</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'soft-green': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        'soft-gray': {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-transition { transition: all 0.3s ease-in-out; }
        .content-transition { transition: all 0.3s ease-in-out; }
        .hover-lift { transition: transform 0.2s ease-in-out; }
        .hover-lift:hover { transform: translateY(-2px); }
    </style>
</head>

<body class="bg-soft-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg sidebar-transition">
            <!-- Logo/Brand -->
            <div class="h-16 flex items-center justify-center border-b border-soft-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-soft-green-400 to-soft-green-500 rounded-xl flex items-center justify-center shadow-sm">
                        <i class="fas fa-user-graduate text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold text-soft-gray-800">Sistema</h1>
                        <p class="text-xs text-soft-gray-500">Aprendiz</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('aprendiz.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 bg-green-50 text-green-700 rounded-xl transition-all duration-200 group">
                        <i class="fas fa-globe w-5 text-center text-green-600"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <!-- Residuos Orgánicos -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                        <i class="fas fa-recycle w-5 text-center group-hover:text-soft-green-600"></i>
                        <span class="font-medium">Residuos Orgánicos</span>
                    </a>
                    
                    <!-- Creación de Pilas -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                        <i class="fas fa-mountain w-5 text-center group-hover:text-soft-green-600"></i>
                        <span class="font-medium">Creación de Pilas</span>
                    </a>
                    
                    <!-- Maquinaria -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                        <i class="fas fa-cogs w-5 text-center group-hover:text-soft-green-600"></i>
                        <span class="font-medium">Maquinaria</span>
                    </a>
                    
                    <!-- Abono -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                        <i class="fas fa-seedling w-5 text-center group-hover:text-soft-green-600"></i>
                        <span class="font-medium">Abono</span>
                    </a>
                </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="h-16 bg-green-100 shadow-sm border-b border-soft-gray-200 flex items-center justify-between px-6">
                <div class="flex items-center space-x-4">
                    <h2 class="text-xl font-semibold text-soft-gray-800">Panel de Aprendiz</h2>
                </div>
                
                                            <!-- User Menu -->
                            <div class="flex items-center space-x-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center space-x-3 hover:bg-soft-gray-100 rounded-lg px-3 py-2 transition-all duration-200">
                                        <div class="w-8 h-8 bg-gradient-to-br from-soft-green-400 to-soft-green-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user-graduate text-white text-sm"></i>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-soft-gray-800">{{ Auth::user()->name }}</p>
                                            <p class="text-xs text-soft-gray-500">Aprendiz</p>
                                        </div>
                                        <i class="fas fa-chevron-down text-soft-gray-400 text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                                    </button>
                                    
                                    <!-- Dropdown Menu -->
                                    <div x-show="open" 
                                         @click.away="open = false"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-95"
                                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-soft-gray-200 py-2 z-50">
                                        
                                        <!-- User Info -->
                                        <div class="px-4 py-2 border-b border-soft-gray-100">
                                            <p class="text-sm font-medium text-soft-gray-800">{{ Auth::user()->name }}</p>
                                            <p class="text-xs text-soft-gray-500">{{ Auth::user()->email }}</p>
                                        </div>
                                        
                                        <!-- Menu Items -->
                                        <div class="py-1">
                                            <a href="#" class="flex items-center px-4 py-2 text-sm text-soft-gray-700 hover:bg-soft-gray-50 transition-colors duration-200">
                                                <i class="fas fa-user-cog w-4 text-soft-gray-400 mr-3"></i>
                                                Perfil
                                            </a>
                                            <a href="{{ url('/') }}" class="flex items-center px-4 py-2 text-sm text-soft-gray-700 hover:bg-soft-gray-50 transition-colors duration-200">
                                                <i class="fas fa-home w-4 text-soft-gray-400 mr-3"></i>
                                                Welcome
                                            </a>
                                        </div>
                                        
                                        <!-- Divider -->
                                        <div class="border-t border-soft-gray-100 my-1"></div>
                                        
                                        <!-- Logout -->
                                        <form method="POST" action="{{ route('logout') }}" class="block">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                                <i class="fas fa-sign-out-alt w-4 mr-3"></i>
                                                Cerrar Sesión
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-soft-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
