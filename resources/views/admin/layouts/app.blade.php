<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/tu_kit_aqui.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="font-['Oswald'] font-bold bg-primary text-white">

    <!-- Botón de menú móvil -->
    <div class="lg:hidden">
        <button id="mobile-menu-button"
            class="m-4 p-3 rounded-md bg-[#151515] focus:outline-none shadow-md hover:bg-[#1f1f1f] transition-all">
            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <line x1="3" y1="6" x2="21" y2="6" stroke-width="2" stroke="currentColor" />
                <line x1="3" y1="12" x2="21" y2="12" stroke-width="2" stroke="currentColor" />
                <line x1="3" y1="18" x2="21" y2="18" stroke-width="2" stroke="currentColor" />
            </svg>
        </button>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar móvil -->
        <div id="mobile-sidebar" class="lg:hidden fixed inset-0 z-40 hidden">
            <div id="mobile-overlay" class="fixed inset-0 bg-black/70 backdrop-blur-sm"></div>
            <div class="relative flex flex-col w-72 max-w-xs bg-[#1a1a1a] h-full border-r border-gray-700">
                <div class="absolute top-0 right-0 -mr-12 pt-4">
                    <button id="close-mobile-menu" aria-label="Cerrar menú"
                        class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-800 hover:bg-gray-700 transition">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="mt-6 space-y-3 px-4 py-4">
                    <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.dashboard' : 'receptionist.dashboard') }}"
                        class="nav-item block py-3 px-4 hover:bg-[#252525] rounded-lg transition duration-300">
                        <i class="fa-solid fa-house mr-3 text-[#f36100]"></i>Inicio
                    </a>

                    <!-- Dropdown móvil para usuarios -->
                    <details class="group">
                        <summary
                            class="flex items-center justify-between py-3 px-4 cursor-pointer hover:bg-[#252525] rounded-lg transition duration-300">
                            <span class="flex items-center">
                                <i class="fa-solid fa-users mr-3 text-[#f36100]"></i>
                                Usuarios
                            </span>
                            <i class="fa-solid fa-chevron-down text-sm text-gray-400 group-open:rotate-180 transition-transform"></i>
                        </summary>
                        <div class="mt-2 space-y-1 pl-8">
                            <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.users' : 'receptionist.users') }}"
                                class="block py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                                <i class="fa-solid fa-user mr-2 text-[#f36100]"></i>Lista de Usuarios
                            </a>
                            <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.memberships' : 'receptionist.memberships') }}"
                                class="block py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                                <i class="fa-solid fa-id-card mr-2 text-[#f36100]"></i>Membresías
                            </a>
                            <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.payments' : 'receptionist.payments') }}"
                                class="block py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                                <i class="fa-solid fa-money-bill-wave mr-2 text-[#f36100]"></i>Pagos
                            </a>
                        </div>
                    </details>

                    <a href="#"
                        class="nav-item block py-3 px-4 hover:bg-[#252525] rounded-lg transition duration-300">
                        <i class="fa-solid fa-gear mr-3 text-[#f36100]"></i>Configuración
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-8 px-4">
                        @csrf
                        <button type="submit"
                            class="w-full flex justify-center items-center py-3 px-4 bg-[#f36100] rounded-lg transition duration-300 hover:bg-orange-600">
                            <i class="fa-solid fa-right-from-bracket mr-3"></i>Cerrar sesión
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Sidebar escritorio -->
        <aside class="w-full md:w-70 bg-secondary text-white shadow-lg lg:block hidden lg:relative p-4 md:p-8">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-3xl font-bold">Mi Panel</h1>
            </div>
            <nav class="mt-6 space-y-2">
                <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.dashboard' : 'receptionist.dashboard') }}"
                    class="flex items-center gap-3 py-2.5 px-4 hover:bg-[#252525] rounded transition duration-300">
                    <i class="fas fa-home text-[#f36100]"></i>
                    <span>Inicio</span>
                </a>

                <!-- Dropdown escritorio para usuarios -->
                <details class="group">
                    <summary
                        class="flex items-center justify-between gap-3 py-2.5 px-4 cursor-pointer hover:bg-[#252525] rounded transition duration-300">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-users text-[#f36100]"></i>
                            <span>Usuarios</span>
                        </span>
                        <i class="fas fa-chevron-down text-sm text-gray-400 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <div class="mt-2 space-y-1 pl-8">
                        <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.users' : 'receptionist.users') }}"
                            class="flex items-center gap-3 py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                            <i class="fas fa-user text-[#f36100]"></i>
                            <span>Lista de Usuarios</span>
                        </a>
                        <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.memberships' : 'receptionist.memberships') }}"
                            class="flex items-center gap-3 py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                            <i class="fas fa-id-card text-[#f36100]"></i>
                            <span>Membresías</span>
                        </a>
                        <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.payments' : 'receptionist.payments') }}"
                            class="flex items-center gap-3 py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                            <i class="fas fa-money-bill-wave text-[#f36100]"></i>
                            <span>Pagos</span>
                        </a>
                        <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.attendance-users' : 'receptionist.attendance-users') }}"
                            class="flex items-center gap-3 py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                            <i class="fas fa-clipboard-list text-[#f36100]"></i>
                            <span>Aistencias</span>
                        </a>
                    </div>
                </details>

                <!-- Dropdown escritorio para empleados -->
                <details class="group">
                    <summary
                        class="flex items-center justify-between gap-3 py-2.5 px-4 cursor-pointer hover:bg-[#252525] rounded transition duration-300">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-people-group text-[#f36100]"></i>
                            <span>Empleados</span>
                        </span>
                        <i class="fas fa-chevron-down text-sm text-gray-400 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <div class="mt-2 space-y-1 pl-8">
                        <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.users' : 'receptionist.users') }}"
                            class="flex items-center gap-3 py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                            <i class="fas fa-user-tie text-[#f36100]"></i>
                            <span>Lista de empleados</span>
                        </a>
                        <a href="{{ route(class_basename($user) === 'Admin' ? 'admin.memberships' : 'receptionist.memberships') }}"
                            class="flex items-center gap-3 py-2 px-4 hover:bg-[#252525] rounded transition duration-300">
                            <i class="fas fa-clipboard-list text-[#f36100]"></i>
                            <span>Aistencias</span>
                        </a>
                    </div>
                </details>

                <a href="#"
                    class="flex items-center gap-3 py-2.5 px-4 hover:bg-[#252525] rounded transition duration-300">
                    <i class="fas fa-cog text-[#f36100]"></i>
                    <span>Configuración</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-4 px-4">
                    @csrf
                    <button type="submit"
                        class="mt-6 w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-[#f36100] hover:bg-orange-600 text-white rounded transition duration-300">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </nav>
        </aside>

        @yield('content')
    </div>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            document.getElementById('mobile-sidebar').classList.remove('hidden');
        });

        document.getElementById('close-mobile-menu').addEventListener('click', () => {
            document.getElementById('mobile-sidebar').classList.add('hidden');
        });
    </script>
</body>

</html>
