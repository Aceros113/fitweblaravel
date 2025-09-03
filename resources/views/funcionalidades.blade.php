@extends('layouts.app')

@section('content')
    <title>FitWeb Funcionalidades</title>

    <section class="relative bg-cover bg-center py-50" style="background-image: url('/img/breadcrumb-bg.jpg')"
        data-aos="fade-in">
        <!-- Overlay negro con opacidad -->
        <div class="absolute inset-0 bg-black/70"></div>

        <div class="container relative z-10 mx-auto px-4 text-center">
            <h2 class="text-5xl md:text-6xl font-extrabold text-white mb-6">Funcionalidades</h2>
            <div class="text-white space-x-2 text-lg">
                <a href="/" class="hover:underline transition-all">Inicio</a>
                <span>></span>
                <span class="text-tertiary">Funcionalidades</span>
            </div>
        </div>
    </section>



    <!-- Service Section -->
    <section class="py-20 bg-primary" data-aos="fade-up" data-aos-duration="500">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-tertiary font-semibold uppercase">Características principales</span>
                <h2 class="text-3xl text-white font-bold mt-2">Todo lo que necesitas en una plataforma</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Card -->
                <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 
                       hover:scale-105 active:scale-95 focus:scale-105 
                       hover:shadow-orange-500/50 active:shadow-orange-500/50 focus:shadow-orange-500/50
                       border-2 border-transparent hover:border-orange-500 active:border-orange-500 focus:border-orange-500 
                       group cursor-pointer"
                    data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                    <div class="flex justify-center mb-6 text-tertiary">
                        <i
                            class="fas fa-tachometer-alt text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                    </div>
                    <h4
                        class="text-2xl font-extrabold mb-4 text-white group-hover:text-orange-500 group-active:text-orange-500 group-focus:text-orange-500">
                        Panel de Control
                    </h4>
                    <ul class="text-gray-400 space-y-3 text-lg">
                        <li>Métricas en tiempo real</li>
                        <li>Seguimiento de ingresos</li>
                        <li>Análisis de tendencias</li>
                        <li>Acceso rápido</li>
                    </ul>
                </div>
                <!-- Card Gestión de Clientes -->
                <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 
           hover:scale-105 active:scale-95 focus:scale-105 
           hover:shadow-orange-500/50 active:shadow-orange-500/50 focus:shadow-orange-500/50
           border-2 border-transparent hover:border-orange-500 active:border-orange-500 focus:border-orange-500 
           group cursor-pointer"
                    data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                    <div class="flex justify-center mb-6 text-tertiary">
                        <i
                            class="fas fa-users text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                    </div>
                    <h4
                        class="text-2xl font-extrabold mb-4 text-white group-hover:text-orange-500 group-active:text-orange-500 group-focus:text-orange-500">
                        Gestión de Clientes
                    </h4>
                    <ul class="text-gray-400 space-y-3 text-lg">
                        <li>Perfiles detallados</li>
                        <li>Control de membresías</li>
                        <li>Registro de asistencia</li>
                        <li>Renovaciones automáticas</li>
                    </ul>
                </div>

                <!-- Card Gestión de Empleados -->
                <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 
           hover:scale-105 active:scale-95 focus:scale-105 
           hover:shadow-orange-500/50 active:shadow-orange-500/50 focus:shadow-orange-500/50
           border-2 border-transparent hover:border-orange-500 active:border-orange-500 focus:border-orange-500 
           group cursor-pointer"
                    data-aos="fade-up" data-aos-delay="300" data-aos-duration="400">
                    <div class="flex justify-center mb-6 text-tertiary">
                        <i
                            class="fas fa-user-tie text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                    </div>
                    <h4
                        class="text-2xl font-extrabold mb-4 text-white group-hover:text-orange-500 group-active:text-orange-500 group-focus:text-orange-500">
                        Gestión de Empleados
                    </h4>
                    <ul class="text-gray-400 space-y-3 text-lg">
                        <li>Horarios personalizados</li>
                        <li>Control de disponibilidad</li>
                        <li>Sistema de check-in</li>
                        <li>Optimización de recursos</li>
                    </ul>
                </div>

                <!-- Card Programación -->
                <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 
           hover:scale-105 active:scale-95 focus:scale-105 
           hover:shadow-orange-500/50 active:shadow-orange-500/50 focus:shadow-orange-500/50
           border-2 border-transparent hover:border-orange-500 active:border-orange-500 focus:border-orange-500 
           group cursor-pointer"
                    data-aos="fade-up" data-aos-delay="400" data-aos-duration="400">
                    <div class="flex justify-center mb-6 text-tertiary">
                        <i
                            class="fas fa-calendar-alt text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                    </div>
                    <h4
                        class="text-2xl font-extrabold mb-4 text-white group-hover:text-orange-500 group-active:text-orange-500 group-focus:text-orange-500">
                        Programación
                    </h4>
                    <ul class="text-gray-400 space-y-3 text-lg">
                        <li>Calendario interactivo</li>
                        <li>Reservas en tiempo real</li>
                        <li>Control de cupos</li>
                        <li>Notificaciones automáticas</li>
                    </ul>
                </div>

                <!-- Card Reportes Avanzados -->
                <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 
           hover:scale-105 active:scale-95 focus:scale-105 
           hover:shadow-orange-500/50 active:shadow-orange-500/50 focus:shadow-orange-500/50
           border-2 border-transparent hover:border-orange-500 active:border-orange-500 focus:border-orange-500 
           group cursor-pointer"
                    data-aos="fade-up" data-aos-delay="500" data-aos-duration="400">
                    <div class="flex justify-center mb-6 text-tertiary">
                        <i
                            class="fas fa-chart-bar text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                    </div>
                    <h4
                        class="text-2xl font-extrabold mb-4 text-white group-hover:text-orange-500 group-active:text-orange-500 group-focus:text-orange-500">
                        Reportes Avanzados
                    </h4>
                    <ul class="text-gray-400 space-y-3 text-lg">
                        <li>Gráficos interactivos</li>
                        <li>Comparativas mensuales</li>
                        <li>Análisis de horas pico</li>
                        <li>Exportación de datos</li>
                    </ul>
                </div>

                <!-- Card Seguridad Integral -->
                <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 
           hover:scale-105 active:scale-95 focus:scale-105 
           hover:shadow-orange-500/50 active:shadow-orange-500/50 focus:shadow-orange-500/50
           border-2 border-transparent hover:border-orange-500 active:border-orange-500 focus:border-orange-500 
           group cursor-pointer"
                    data-aos="fade-up" data-aos-delay="600" data-aos-duration="400">
                    <div class="flex justify-center mb-6 text-tertiary">
                        <i
                            class="fas fa-shield-alt text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                    </div>
                    <h4
                        class="text-2xl font-extrabold mb-4 text-white group-hover:text-orange-500 group-active:text-orange-500 group-focus:text-orange-500">
                        Seguridad Integral
                    </h4>
                    <ul class="text-gray-400 space-y-3 text-lg">
                        <li>Encriptación de datos</li>
                        <li>Copias de seguridad</li>
                        <li>Acceso multi-nivel</li>
                        <li>Protección anti-fraude</li>
                    </ul>
                </div>


            </div>
        </div>
    </section>

    <!-- Banner Section Mejorado -->
    <section class="relative bg-cover bg-center py-32" style="background-image: url('/img/banner.png')" data-aos="zoom-in"
        data-aos-duration="500">
        <div class="absolute inset-0 bg-black/70"></div> <!-- Capa oscura -->
        <div class="container relative z-10 mx-auto px-6 text-center">
            <h2 class="text-6xl font-extrabold text-white mb-6 drop-shadow-lg animate-fade-down">Contáctanos para obtener
                más información</h2>
            <p class="text-2xl text-gray-300 mb-10 animate-fade-up">Donde el fitness y la tecnología se encuentran.</p>
            <a href="/contactanos"
                class="m-5 inline-block bg-gradient-to-r from-[#f36100] via-orange-600 to-orange-700 hover:scale-110 transform transition-all duration-500 text-white py-4 px-8 rounded-full text-lg font-bold shadow-2xl hover:shadow-orange-500/50 animate-bounce">
                Obtener Información
            </a>
        </div>
    </section>
@endsection
