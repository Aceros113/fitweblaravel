<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title>FitWeb Login</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-['Oswald'] font-bold antialiased bg-primary">
    <section class="login-section flex items-center min-h-screen py-6 bg-black">
        <div class="container mx-auto px-4">
            <div class="bg-[#151515] rounded-lg shadow-2xl max-w-4xl mx-auto md:my-12 border-1 border-[#2D2D2D]">
                <div class="flex flex-col md:flex-row">
                    <!-- Imagen -->
                    <div class="w-full md:w-5/12">
                        <img src="img/hero/hero8c.webp" alt="login"
                            class="w-full h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-tr-none">
                    </div>

                    <!-- Formulario de login -->
                    <div class="w-full md:w-7/12 p-8">
                        <div class="text-center mb-6">
                            <div class="mx-auto w-1/2 lg:w-1/3">
                                <img src="img/logotipo.png" alt="logo"
                                    class="login-logo default_cursor_land transition-all duration-500 hover:scale-110 hover:translate-y-[-5px]">
                            </div>
                        </div>

                        @if (session('message'))
                            <div class="alert alert-danger mt-3 bg-red-500 text-white p-4 rounded-lg mb-4">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/login') }}">
                            @csrf
                            <p class="text-xl text-center text-[#f36100] mt-3 mb-6">INICIA SESIÓN EN TU CUENTA</p>

                            <!-- Input Correo -->
                            <div class="mb-4">
                                <label for="email" class="sr-only">Correo</label>
                                <input type="email" name="email" id="email"
                                    class="w-full p-4 bg-[#252525] text-white border border-gray-600 rounded-lg
                                        focus:border-[#f36100] focus:ring focus:ring-[#f36100]/80 focus:outline-none transition-all duration-500 font-light"
                                    placeholder="Correo electrónico" required>
                            </div>

                            <!-- Input Contraseña -->
                            <div class="mb-6 relative">
                                <label for="password" class="sr-only">Contraseña</label>
                                <input type="password" name="password" id="password"
                                    class="w-full p-4 bg-[#252525] text-white border border-gray-600 rounded-lg
                                        focus:border-[#f36100] focus:ring focus:ring-[#f36100]/80 focus:outline-none transition-all duration-500 font-light"
                                    placeholder="Contraseña" required>

                                <!-- Icono de mostrar/ocultar contraseña -->
                                <button type="button" id="togglePassword"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white">
                                    <!-- Ojo cerrado (mostrar contraseña) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12l-3 3m0 0l-3-3m3 3V9m6.75 2.25a9.953 9.953 0 00-3.607-7.477A9.953 9.953 0 0012 4.5a9.953 9.953 0 00-6.75 2.25M9 12a3 3 0 015.5 0m0 0A3 3 0 0115 12" />
                                    </svg>
                                </button>
                            </div>

                            <script>
                                const togglePassword = document.getElementById('togglePassword');
                                const passwordField = document.getElementById('password');

                                togglePassword.addEventListener('click', () => {
                                    // Cambia el tipo de input entre 'password' y 'text'
                                    const type = passwordField.type === 'password' ? 'text' : 'password';
                                    passwordField.type = type;

                                    // Cambiar el ícono si la contraseña es visible
                                    togglePassword.innerHTML = type === 'password' ?
                                        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12l-3 3m0 0l-3-3m3 3V9m6.75 2.25a9.953 9.953 0 00-3.607-7.477A9.953 9.953 0 0012 4.5a9.953 9.953 0 00-6.75 2.25M9 12a3 3 0 015.5 0m0 0A3 3 0 0115 12" /></svg>' :
                                        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5l14 14M5 19l14-14" /></svg>';
                                });
                            </script>

                            <!-- Botón Iniciar Sesión -->
                            <input name="login" id="login"
                                class="w-full py-3 bg-[#f36100] text-white rounded-lg 
                                hover:bg-[#ff6a00] hover:text-[#151515] active:scale-95 transition-all duration-300 cursor-pointer mb-4"
                                type="submit" value="Iniciar sesión">

                            <!-- Botón Regresar al Inicio -->
                            <a href="/"
                                class="block w-full py-3 border border-gray-500 text-gray-300 text-center rounded-lg 
                                    hover:border-[#f36100] hover:text-[#f36100] active:scale-95 transition-all duration-300">
                                Regresar al Inicio
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')

</body>
