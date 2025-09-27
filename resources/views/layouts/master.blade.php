<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de Compostaje</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        
        /* Animaciones para el submenú */
        .submenu-container {
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .submenu-hidden {
            max-height: 0;
            opacity: 0;
            transform: translateY(-10px);
        }
        
        .submenu-visible {
            max-height: 200px;
            opacity: 1;
            transform: translateY(0);
        }
        
        .submenu-item {
            transition: all 0.2s ease-in-out;
            transform: translateX(-10px);
            opacity: 0;
        }
        
        .submenu-item.animate-in {
            transform: translateX(0);
            opacity: 1;
        }
        
        .arrow-transition {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-soft-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg sidebar-transition">
            <!-- Logo/Brand -->
            <div class="h-16 flex items-center justify-center border-b border-soft-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-soft-green-500 to-soft-green-600 rounded-xl flex items-center justify-center shadow-sm">
                        <i class="fas fa-seedling text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold text-soft-gray-800">Sistema</h1>
                        <p class="text-xs text-soft-gray-500">Compostaje</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard.admin') }}" class="flex items-center space-x-3 px-4 py-3 bg-green-50 text-green-700 rounded-xl transition-all duration-200 group">
                        <i class="fas fa-globe w-5 text-center text-green-600"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <!-- Gestionar Pasantes -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                        <i class="fas fa-users w-5 text-center group-hover:text-soft-green-600"></i>
                        <span class="font-medium">Gestionar Pasantes</span>
                    </a>
                    
                    <!-- Monitoreo -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                        <i class="fas fa-chart-line w-5 text-center group-hover:text-soft-green-600"></i>
                        <span class="font-medium">Monitoreo</span>
                    </a>
                    
                    <!-- Residuos Orgánicos -->
                    <div class="relative">
                        <button onclick="toggleSubmenu('organicSubmenu', 'organicArrow')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-recycle w-5 text-center group-hover:text-soft-green-600"></i>
                                <span class="font-medium">Residuos</span>
                            </div>
                            <i id="organicArrow" class="fas fa-chevron-down text-soft-gray-400 text-xs arrow-transition"></i>
                        </button>

                        <!-- Submenú con animaciones -->
                        <div id="organicSubmenu" class="submenu-container submenu-hidden ml-10 mt-2 space-y-2">
                            <a href="{{ route('admin.organic.index') }}" 
                               class="submenu-item flex items-center space-x-3 px-4 py-2 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-lg font-medium">
                                <i class="fas fa-list w-4 text-center group-hover:text-soft-green-600"></i>
                                <span>Ver Registros</span>
                            </a>
                            <a href="{{ route('admin.organic.create') }}" 
                               class="submenu-item flex items-center space-x-3 px-4 py-2 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-lg font-medium">
                                <i class="fas fa-plus w-4 text-center group-hover:text-soft-green-600"></i>
                                <span>Registrar Nuevo</span>
                            </a>
                        </div>
                    </div>

                    <!-- Bodega de Clasificación -->
                    <div class="relative">
                        <button onclick="toggleSubmenu('warehouseSubmenu', 'warehouseArrow')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-warehouse w-5 text-center group-hover:text-soft-green-600"></i>
                                <span class="font-medium">Bodega</span>
                            </div>
                            <i id="warehouseArrow" class="fas fa-chevron-down text-soft-gray-400 text-xs arrow-transition"></i>
                        </button>

                        <!-- Submenú con animaciones -->
                        <div id="warehouseSubmenu" class="submenu-container submenu-hidden ml-10 mt-2 space-y-2">
                            <a href="{{ route('admin.warehouse.index') }}"
                               class="submenu-item flex items-center space-x-3 px-4 py-2 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-lg font-medium">
                                <i class="fas fa-boxes w-4 text-center group-hover:text-soft-green-600"></i>
                                <span>Inventario</span>
                            </a>
                        </div>
                    </div>
                    
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
                    <div class="relative">
                        <button onclick="toggleSubmenu('abonoSubmenu', 'abonoArrow')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-xl transition-all duration-200 group">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-seedling w-5 text-center group-hover:text-soft-green-600"></i>
                                <span class="font-medium">Abono</span>
                            </div>
                            <i id="abonoArrow" class="fas fa-chevron-down text-soft-gray-400 text-xs arrow-transition"></i>
                        </button>

                        <!-- Submenú con animaciones -->
                        <div id="abonoSubmenu" class="submenu-container submenu-hidden ml-10 mt-2 space-y-2">
                            <a href="{{ route('admin.create') }}" 
                               class="submenu-item flex items-center space-x-3 px-4 py-2 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-lg font-medium">
                                <i class="fas fa-edit w-4 text-center group-hover:text-soft-green-600"></i>
                                <span>Registro</span>
                            </a>
                            <a href="" 
                               class="submenu-item flex items-center space-x-3 px-4 py-2 text-soft-gray-700 hover:bg-soft-green-50 hover:text-soft-green-700 rounded-lg font-medium">
                                <i class="fas fa-list w-4 text-center group-hover:text-soft-green-600"></i>
                                <span>Listas</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="h-16 bg-green-100 shadow-sm border-b border-soft-gray-200 flex items-center justify-between px-6">
                <div class="flex items-center space-x-4">
                    <h2 class="text-xl font-semibold text-soft-gray-800">Panel de Administración</h2>
                </div>
                
                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button onclick="toggleSubmenu('userMenu', 'userArrow')" 
                            class="flex items-center space-x-3 hover:bg-soft-gray-100 rounded-lg px-3 py-2 transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-soft-green-500 to-soft-green-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-soft-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-soft-gray-500">Administrador</p>
                            </div>
                            <i id="userArrow" class="fas fa-chevron-down text-soft-gray-400 text-xs transition-transform duration-200"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-soft-gray-200 py-2 z-50">
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


    <script>
        function toggleSubmenu(id, arrowId) {
            const submenu = document.getElementById(id);
            const arrow = document.getElementById(arrowId);

            // Para los menús con animaciones (Abono, Organic Waste y Warehouse)
            if (id === 'abonoSubmenu' || id === 'organicSubmenu' || id === 'warehouseSubmenu') {
                const isHidden = submenu.classList.contains('submenu-hidden');
                const submenuItems = submenu.querySelectorAll('.submenu-item');
                
                if (isHidden) {
                    // Mostrar el submenú
                    submenu.classList.remove('submenu-hidden');
                    submenu.classList.add('submenu-visible');
                    arrow.classList.add('rotate-180');
                    
                    // Animar cada elemento del submenú con delay
                    submenuItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.add('animate-in');
                        }, index * 100); // 100ms de delay entre cada elemento
                    });
                } else {
                    // Ocultar el submenú
                    submenu.classList.remove('submenu-visible');
                    submenu.classList.add('submenu-hidden');
                    arrow.classList.remove('rotate-180');
                    
                    // Remover las animaciones
                    submenuItems.forEach(item => {
                        item.classList.remove('animate-in');
                    });
                }
            } else {
                // Para otros menús (como el menú de usuario)
                submenu.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            }
        }



    </script>
</body>
</html>
