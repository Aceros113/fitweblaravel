<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Recepcionista Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-white">
    <!-- Contenedor con margen y posicionamiento fijo -->
    <div class="lg:hidden">
        <!-- Botón con márgenes internas y sombra -->
        <button id="mobile-menu-button"
            class="m-4 p-3 rounded-md bg-gray-700 hover:bg-gray-600 focus:outline-none shadow-md transition-all duration-300">
            <svg class="hamburger-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
        </button>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar para móvil -->
        <div id="mobile-sidebar" class="lg:hidden fixed inset-0 z-40 closed">
            <div id="mobile-overlay" class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm opacity-0 invisible"></div>
            <div class="relative flex-1 flex flex-col w-72 max-w-xs bg-gray-800 h-full border-r border-gray-700">
                <div class="absolute top-0 right-0 -mr-12 pt-4">
                    <button id="close-mobile-menu" aria-label="Cerrar menú"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none bg-gray-700 hover:bg-gray-600 transition-all duration-300">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6 border-b border-gray-700">
                    <h1 class="text-2xl font-bold text-orange-400">Mi Panel</h1>
                </div>
                <nav class="mt-6 space-y-3 px-4 py-4">
                    <a href="dashboard"
                        class="nav-item block py-3 px-4 hover:bg-gray-700/50 rounded-lg text-gray-200 hover:text-white">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Inicio
                        </span>
                    </a>
                    <a href="{{ route('receptionist.users') }}"
                        class="nav-item block py-3 px-4 hover:bg-gray-700/50 rounded-lg text-gray-200 hover:text-white">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Usuarios
                        </span>
                    </a>
                    <a href="{{ route('receptionist.memberships') }}"
                        class="nav-item block py-3 px-4 hover:bg-gray-700/50 rounded-lg text-gray-200 hover:text-white">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Membresías
                        </span>
                    </a>
                    <a href="#"
                        class="nav-item block py-3 px-4 hover:bg-gray-700/50 rounded-lg text-gray-200 hover:text-white">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Configuración
                        </span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-10 px-4">
                        @csrf
                        <button type="submit"
                            class="w-full nav-item flex items-center py-3 px-4 bg-orange-600 hover:bg-orange-700 rounded-lg transition-all duration-300 group">
                            <svg class="w-5 h-5 mr-3 transform group-hover:rotate-12 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Cerrar sesión
                        </button>
                    </form>
                </nav>
            </div>
        </div>


        <!-- Sidebar (oculto en móvil) -->
        <aside class="w-full md:w-64 bg-gray-800 text-gray-100 shadow-lg md:block hidden md:relative p-4 lg:p-8">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-2xl font-bold">Mi Panel</h1>
            </div>
            <nav class="mt-6 space-y-2">
                <a href="#" class="block py-2.5 px-4 hover:bg-gray-700 rounded">Inicio</a>
                <a href="{{ route('receptionist.users') }}" class="block py-2.5 px-4 hover:bg-gray-700 rounded">Usuarios</a>
                <a href="{{ route('receptionist.memberships') }}" class="block py-2.5 px-4 hover:bg-gray-700 rounded">Membresías</a>
                <a href="#" class="block py-2.5 px-4 hover:bg-gray-700 rounded">Configuración</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4 px-4">
                    @csrf
                    <button type="submit"
                        class="w-full text-left py-2.5 px-4 bg-orange-600 hover:bg-orange-700 rounded">Cerrar
                        sesión</button>
                </form>
            </nav>
        </aside>


        @yield('content')
</body>

</html>
