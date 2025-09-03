@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-200 flex items-center bg-cover bg-center bg-blend-overlay "
        style="background-image: url('img/hero/hero8.webp');" data-aos="fade-up" data-aos-duration="400">
        <!-- Capa oscura + degradado -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/60 to-black"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-delay="200" data-aos-duration="400">

                </div>

                <div class="lg:w-1/2 text-white flex justify-center items-center">
                    <div class="mt-20 space-y-6 text-center animate__animated animate__fadeIn animate__delay-0.5s">
                        <span
                            class="text-2xl font-semibold text-white block mb-6 opacity-80 animate__animated animate__fadeIn animate__delay-1s">Transforma
                            tu gimnasio hoy mismo</span>
                        <h1
                            class="text-5xl md:text-7xl font-extrabold leading-tight text-white animate__animated animate__fadeIn animate__delay-1s">
                            <span class="text-tertiary">FitWeb</span> - Tu Socio Digital
                        </h1>

                        <!-- Botón interactivo -->
                        <a href="contactanos"
                            class="inline-block bg-gradient-to-r from-[#f36100] to-[#ff6500] hover:bg-gradient-to-r hover:from-[#ff6500] hover:to-[#f3a00b] text-white font-extrabold py-4 px-8 rounded-lg transform transition-all duration-500 hover:scale-110 hover:shadow-2xl hover:shadow-[#f36100] mt-8 text-lg md:text-xl"
                            data-aos="zoom-in" data-aos-delay="300" data-aos-duration="300">
                            Agendar Demo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem Section -->
    <section class="py-20 bg-black" data-aos="fade-up" data-aos-duration="400">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-tertiary font-semibold uppercase">Problemas que Resolvemos</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2 text-white">GESTIÓN DE GIMNASIOS</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Item 1 -->
                <div class="bg-[#151515] p-8 rounded-xl shadow-2xl text-center transform transition-all duration-500 
                hover:scale-105 hover:shadow-xl hover:shadow-[#f36100]/50 
                active:scale-95 focus:scale-105 group cursor-pointer 
                border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100]"
                    data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                    <div class="text-[#f36100] text-5xl mb-6 group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100]">
                        Automatización Integral
                    </h4>
                    <p class="text-gray-400 text-lg font-light">Elimina procesos manuales en reservas, pagos y control de
                        acceso con nuestra plataforma todo-en-uno</p>
                </div>

                <!-- Item 2 -->
                <div class="bg-[#151515] p-8 rounded-xl shadow-2xl text-center transform transition-all duration-500 
                hover:scale-105 hover:shadow-xl hover:shadow-[#f36100]/50 
                active:scale-95 focus:scale-105 group cursor-pointer 
                border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100]"
                    data-aos="fade-up" data-aos-delay="400" data-aos-duration="400">
                    <div class="text-[#f36100] text-5xl mb-6 group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100]">
                        Toma de Decisiones Inteligente
                    </h4>
                    <p class="text-gray-400 text-lg font-light">Dashboard ejecutivo con métricas clave para una gestión
                        basada en datos reales</p>
                </div>

                <!-- Item 3 -->
                <div class="bg-[#151515] p-8 rounded-xl shadow-2xl text-center transform transition-all duration-500 
                hover:scale-105 hover:shadow-xl hover:shadow-[#f36100]/50 
                active:scale-95 focus:scale-105 group cursor-pointer 
                border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100]"
                    data-aos="fade-up" data-aos-delay="600" data-aos-duration="400">
                    <div class="text-[#f36100] text-5xl mb-6 group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fas fa-expand"></i>
                    </div>
                    <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100]">
                        Escalabilidad Garantizada
                    </h4>
                    <p class="text-gray-400 text-lg font-light">Solución adaptable para gimnasios pequeños y medianos sin
                        costos adicionales por crecimiento</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-[#151515]" data-aos="fade-up" data-aos-duration="400">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-[#f36100] font-semibold uppercase">Funcionalidades Clave</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2 text-white">PLATAFORMA TODO-EN-UNO</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-[#0e0e0e] rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300"
                    data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                    <img src="img/classes/dashboard.webp" alt="Panel de Control" class="w-full h-48 object-cover">
                    <div class="p-6 bg-[#0A0A0A] text-white">
                        <div class="flex items-center text-[#f36100] mb-2">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            <span class="font-semibold">Dashboard Inteligente</span>
                        </div>
                        <h5 class="text-lg font-bold">Métricas en Tiempo Real</h5>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-[#0e0e0] rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300"
                    data-aos="fade-up" data-aos-delay="400" data-aos-duration="400">
                    <img src="img/classes/customer-management.webp" alt="Gestión de Clientes"
                        class="w-full h-48 object-cover">
                    <div class="p-6 bg-[#0A0A0A] text-white">
                        <div class="flex items-center text-[#f36100] mb-2">
                            <i class="fas fa-users mr-2"></i>
                            <span class="font-semibold">Gestión de Clientes</span>
                        </div>
                        <h5 class="text-lg font-bold">Perfiles Detallados + Historial Completo</h5>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-[#0e0e0e] rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300"
                    data-aos="fade-up" data-aos-delay="600" data-aos-duration="400">
                    <img src="img/classes/calender.webp" alt="Calendario Interactivo" class="w-full h-48 object-cover">
                    <div class="p-6 bg-[#0A0A0A] text-white">
                        <div class="flex items-center text-[#f36100] mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span class="font-semibold">Calendario Interactivo</span>
                        </div>
                        <h5 class="text-lg font-bold">Programación + Reservas</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-14 bg-cover bg-center" style="background-image: url('img/classes/gym-background.webp')"
        data-aos="fade-up" data-aos-duration="400">
        <div class="py-12">
            <div class="container mx-auto px-4">
                <div class="text-center text-white mb-24">
                    <h2 class="text-3xl md:text-5xl font-bold text-[#f36100]">Beneficios para Administradores</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Benefit 1 -->
                    <div class="text-center text-white" data-aos="fade-up" data-aos-delay="200"
                        data-aos-duration="400">
                        <div class="text-[#f36100] text-4xl mb-4">
                            <i class="far fa-clock"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">+ Eficiencia</h3>
                        <h4 class="text-lg">Automatización de procesos</h4>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="text-center text-white" data-aos="fade-up" data-aos-delay="400"
                        data-aos-duration="400">
                        <div class="text-[#f36100] text-4xl mb-4">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">- Errores</h3>
                        <h4 class="text-lg">Gestión financiera precisa</h4>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="text-center text-white" data-aos="fade-up" data-aos-delay="600"
                        data-aos-duration="400">
                        <div class="text-[#f36100] text-4xl mb-4">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">+ Retención</h3>
                        <h4 class="text-lg">Clientes satisfechos</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Business Model Section -->
    <section class="py-20 bg-[#0A0A0A]" data-aos="fade-up" data-aos-duration="400">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-[#f36100] font-semibold uppercase">Modelo de Negocio</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2 text-white">INVERSIÓN INTELIGENTE</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Plan 1 -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                    <div class="text-[#f36100] text-4xl mb-4">
                        <i class="fas fa-rocket text-white text-2xl bg-[#f36100] p-6 rounded-full"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-3 text-[#f36100]">Plan Único</h4>
                    <p class="text-white font-light">Incluye todas las funcionalidades para administradores, sin límite de
                        usuarios
                        o transacciones.</p>
                </div>

                <!-- Plan 2 -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="400">
                    <div class="text-[#f36100] text-4xl mb-4">
                        <i class="fas fa-gift text-white text-2xl bg-[#f36100] p-6 rounded-full"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-3 text-[#f36100]">Garantía de Satisfacción</h4>
                    <p class="text-white font-light">30 días de prueba totalmente gratuita.</p>
                </div>

                <!-- Plan 3 -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="400">
                    <div class="text-[#f36100] text-4xl mb-4">
                        <i class="fas fa-headset text-white text-2xl bg-[#f36100] p-6 rounded-full"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-3 text-[#f36100]">Soporte Prioritario</h4>
                    <p class="text-white font-light">Asistencia técnica 24/7, capacitación inicial y actualizaciones
                        gratuitas.</p>
                </div>
            </div>
        </div>
    </section>


    <section class="relative bg-cover bg-center py-32" style="background-image: url('/img/banner.png')"
        data-aos="zoom-in" data-aos-duration="400">
        <div class="absolute inset-0 bg-black/70"></div> <!-- Capa oscura -->
        <div class="container relative z-10 mx-auto px-6 text-center">
            <h2 class="text-6xl font-extrabold text-white mb-6 drop-shadow-lg animate-fade-down">Contáctanos para obtener
                más información</h2>
            <p class="text-2xl text-gray-300 mb-10 animate-fade-up">Donde el fitness y la tecnología se encuentran.</p>
            <a href="/contactanos"
                class="m-7 inline-block bg-gradient-to-r from-[#f36100] via-orange-600 to-orange-700 hover:scale-110 transform transition-all duration-500 text-white py-4 px-8 rounded-full text-lg font-bold shadow-2xl hover:shadow-[#f36100]/50 animate-bounce">
                Obtener Información
            </a>
        </div>
    </section>

    <!-- Gallery Section -->
    <div class="container mx-auto px-4 pt-6 md:pt-12" data-aos="fade-up">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-delay="100">
            <h2 class="text-3xl md:text-4xl font-bold mt-2 text-white mb-4" data-aos="fade-up" data-aos-delay="200">SE
                PARTE DE LA ERA MODERNA</h2>
            <div class="w-24 h-1 bg-[#f36100] mx-auto" data-aos="fade-up" data-aos-delay="300"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Imagen grande 1 -->
            <div class="md:col-span-2 relative group overflow-hidden rounded-xl shadow-xl hover:shadow-2xl transition-all duration-500"
                data-aos="fade-up" data-aos-delay="400">
                <img src="img/gallery/gallery-9.jpg" alt="Gallery 1"
                    class="w-full h-100 md:h-[32rem] object-cover transition-transform duration-700 group-hover:scale-110">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                    <a href="img/gallery/gallery-9.jpg" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 flex items-center justify-center">
                        <i
                            class="fas fa-expand text-white text-4xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-125"></i>
                    </a>
                    <h3
                        class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        Instalaciones modernas</h3>
                </div>
            </div>

            <!-- Imagen 2 -->
            <div class="relative group overflow-hidden rounded-xl shadow-xl hover:shadow-2xl transition-all duration-500"
                data-aos="fade-up" data-aos-delay="400">
                <img src="img/gallery/gallery-2.jpg" alt="Gallery 2"
                    class="w-full h-100 object-cover transition-transform duration-700 group-hover:scale-110">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                    <a href="img/gallery/gallery-2.jpg" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 flex items-center justify-center">
                        <i
                            class="fas fa-expand text-white text-4xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-125"></i>
                    </a>
                    <h3
                        class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        Tecnología avanzada</h3>
                </div>
            </div>

            <!-- Imagen 3 -->
            <div class="relative group overflow-hidden rounded-xl shadow-xl hover:shadow-2xl transition-all duration-500"
                data-aos="fade-up" data-aos-delay="500">
                <img src="img/gallery/gallery-3.jpg" alt="Gallery 3"
                    class="w-full h-100 object-cover transition-transform duration-700 group-hover:scale-110">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                    <a href="img/gallery/gallery-3.jpg" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 flex items-center justify-center">
                        <i
                            class="fas fa-expand text-white text-4xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-125"></i>
                    </a>
                    <h3
                        class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        Entrenamiento personalizado</h3>
                </div>
            </div>

            <!-- Imagen 4 -->
            <div class="relative group overflow-hidden rounded-xl shadow-xl hover:shadow-2xl transition-all duration-500"
                data-aos="fade-up" data-aos-delay="500">
                <img src="img/gallery/gallery-4.jpg" alt="Gallery 4"
                    class="w-full h-100 object-cover transition-transform duration-700 group-hover:scale-110">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                    <a href="img/gallery/gallery-4.jpg" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 flex items-center justify-center">
                        <i
                            class="fas fa-expand text-white text-4xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-125"></i>
                    </a>
                    <h3
                        class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        Comunidad fitness</h3>
                </div>
            </div>

            <!-- Imagen 5 -->
            <div class="relative group overflow-hidden rounded-xl shadow-xl hover:shadow-2xl transition-all duration-500"
                data-aos="fade-up" data-aos-delay="600">
                <img src="img/gallery/gallery-5.jpg" alt="Gallery 5"
                    class="w-full h-80 object-cover transition-transform duration-700 group-hover:scale-110">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                    <a href="img/gallery/gallery-5.jpg" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 flex items-center justify-center">
                        <i
                            class="fas fa-expand text-white text-4xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-125"></i>
                    </a>
                    <h3
                        class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        Equipo profesional</h3>
                </div>
            </div>

            <!-- Imagen grande 2 -->
            <div class="md:col-span-2 relative group overflow-hidden rounded-xl shadow-xl hover:shadow-2xl transition-all duration-500"
                data-aos="fade-up" data-aos-delay="600">
                <img src="img/gallery/gallery-6.jpg" alt="Gallery 6"
                    class="w-full h-100 md:h-[32rem] object-cover transition-transform duration-700 group-hover:scale-110">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                    <a href="img/gallery/gallery-6.jpg" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 flex items-center justify-center">
                        <i
                            class="fas fa-expand text-white text-4xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-125"></i>
                    </a>
                    <h3
                        class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        Resultados comprobados</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
