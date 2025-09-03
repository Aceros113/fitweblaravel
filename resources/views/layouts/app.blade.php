<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="description" content="fitweb live">
    <meta name="keywords" content="Gym, fitweb live colombia, fitweb, live, colombia">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-['Oswald'] font-bold antialiased bg-primary">

    <!-- Header -->
    <header class="bg-transparent absolute top-0 left-0 w-full z-30 mt-10">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16 md:h-20">
                <div class="flex-shrink-0 "></div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="/" class="text-white hover:text-[#f36100] transition">Inicio</a></li>
                        <li><a href="funcionalidades"
                                class="text-white hover:text-[#f36100] transition">Funcionalidades</a></li>
                        <li><a href="sobre-nosotros" class="text-white hover:text-[#f36100]  transition">Nosotros</a>
                        </li>
                        <li><a href="contactanos" class="text-white hover:text-[#f36100]  transition">Contáctanos</a>
                        </li>
                        <li>
                            <a href="login"
                                class="inline-block bg-[#f36100] hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded-md transition duration-300">
                                Soy FitWeb
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Botón de menú -->
                <div class="md:hidden">
                    <button id="mobile-menu-button"
                        class="m-4 p-3 rounded-md bg-[#0a0a0a] hover:bg-gray-600 focus:outline-none shadow-md transition-all duration-300">
                        <svg class="hamburger-icon" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <line class="hamburger-line" x1="3" y1="6" x2="21" y2="6" />
                            <line class="hamburger-line" x1="3" y1="12" x2="21" y2="12" />
                            <line class="hamburger-line" x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </button>
                </div>

                <!-- Sidebar para móvil -->
                <div id="mobile-sidebar" class="lg:hidden fixed inset-0 z-40 closed">
                    <div id="mobile-overlay" class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm opacity-0 invisible">
                    </div>

                    <div class="relative flex-1 flex flex-col w-72 max-w-xs bg-primary h-full border-r border-primary">
                        <div class="absolute top-0 right-0 -mr-12 pt-4">
                            <button id="close-mobile-menu" aria-label="Cerrar menú"
                                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none bg-[#0a0a0a] hover:bg-gray-600 transition-all duration-300">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <nav class="mt-6 space-y-3 px-4 py-4">
                            <a href="/"
                                class="nav-item flex items-center gap-3 py-3 px-4 hover:bg-gray-700/50 rounded-lg text-gray-200 hover:text-white transition-all duration-300">
                                <i class="fas fa-home text-orange-500"></i>
                                <span>Inicio</span>
                            </a>

                            <a href="funcionalidades"
                                class="nav-item flex items-center gap-3 py-3 px-4 hover:bg-gray-700/50 rounded-lg text-gray-200 hover:text-white transition-all duration-300">
                                <i class="fas fa-cogs text-orange-500"></i>
                                <span>Funcionalidades</span>
                            </a>

                            <a href="sobre-nosotros"
                                class="nav-item flex items-center gap-3 py-3 px-4 hover:bg-gray-700/50 rounded-lg text-gray-200 hover:text-white transition-all duration-300">
                                <i class="fas fa-users text-orange-500"></i>
                                <span>Sobre nosotros</span>
                            </a>

                            <a href="contactanos"
                                class="nav-item flex items-center gap-3 py-3 px-4 hover:bg-gray-700/50 rounded-lg text-gray-200 hover:text-white transition-all duration-300">
                                <i class="fas fa-envelope text-orange-500"></i>
                                <span>Contáctanos</span>
                            </a>

                            <a href="login"
                                class="nav-item flex justify-center items-center gap-3 py-3 px-4 mx-4 my-5 bg-[#f36100] text-white font-semibold rounded-lg 
                                hover:bg-[#ff6a00] hover:shadow-lg transition-all duration-300">
                                <i class="fas fa-user-circle"></i>
                                <span>Soy FitWeb</span>
                            </a>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init(); // Inicializar AOS
    </script>
</body>

</html>
