@extends('layouts.app')

@section('content')
    <title>FitWeb Sobre Nosotros</title>

    <section class="relative bg-cover bg-center py-50" style="background-image: url('/img/breadcrumb-bg.jpg')"
        data-aos="fade-in">
        <!-- Overlay negro con opacidad -->
        <div class="absolute inset-0 bg-black/70"></div>

        <div class="container relative z-10 mx-auto px-4 text-center">
            <h2 class="text-6xl font-extrabold text-white mb-6">Nosotros</h2>
            <div class="text-white space-x-2 text-lg">
                <a href="/" class="hover:underline transition-all">Inicio</a>
                <span>></span>
                <span class="text-tertiary">Nosotros</span>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section class="py-16 bg-primary text-white flex items-center">
        <div class="container mx-auto flex flex-col lg:flex-row gap-16 lg:gap-32">
            <!-- Columna de imagen centrada verticalmente -->
            <div class="lg:w-1/2 mx-auto px-10 lg:px-0 overflow-hidden rounded-xl shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-3 flex justify-center"
                data-aos="fade-up" data-aos-duration="500">
                <img src="img/about-us.jpg"
                    class="w-full h-auto rounded-xl shadow-lg transition-all duration-300 transform group-hover:scale-110 group-hover:rotate-3"
                    alt="Nuestro equipo">
            </div>

            <!-- Contenido de texto -->
            <div class="lg:w-1/2 mx-auto text-center px-5">
                <div class="section-title mb-8">
                    <span
                        class="text-tertiary font-semibold text-lg uppercase tracking-wider animate__animated animate__fadeIn animate__delay-1s"
                        data-aos="fade-up" data-aos-duration="400">Nuestra Historia</span>
                    <h2 class="text-4xl font-extrabold mb-6 text-white leading-tight animate__animated animate__fadeIn animate__delay-1s"
                        data-aos="fade-up" data-aos-duration="500">
                        Transformando la gestión de gimnasios desde 2025
                    </h2>
                </div>
                <p class="text-lg text-gray-300 mb-8 animate__animated animate__fadeIn animate__delay-1s  font-light"
                    data-aos="fade-up" data-aos-duration="500">
                    En FitWeb combinamos pasión por el fitness con tecnología innovadora para ofrecer la solución más
                    completa en gestión deportiva. Nuestro equipo de expertos en software y gestión deportiva trabaja para
                    simplificar las operaciones diarias de tu gimnasio.
                </p>

                <div class="flex flex-wrap gap-8 mb-12 justify-center">
                    <!-- Estadísticas 1 -->
                    <div class="af-item items-center space-x-4 mb-4 animate__animated animate__fadeIn animate__delay-1s grid grid-cols-1 gap-4 p-6 bg-secondary rounded-xl shadow-xl hover:scale-105 transition-all duration-300 hover:border-2 hover:border-[#f36100]"
                        data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
                        <i
                            class="fas fa-dumbbell text-4xl text-tertiary transition-transform duration-500 transform hover:scale-125"></i>
                        <div>
                            <h4 class="text-xl font-semibold">+6 Gimnasios</h4>
                            <p class="text-sm text-gray-400">Confían en nuestra plataforma</p>
                        </div>
                    </div>

                    <!-- Estadísticas 2 -->
                    <div class="af-item items-center space-x-4 mb-4 animate__animated animate__fadeIn animate__delay-1s grid grid-cols-1 gap-4 p-6 bg-secondary rounded-xl shadow-xl hover:scale-105 transition-all duration-300 hover:border-2 hover:border-[#f36100]"
                        data-aos="fade-up" data-aos-duration="500" data-aos-delay="400">
                        <i
                            class="fas fa-chart-line text-4xl text-tertiary transition-transform duration-500 transform hover:scale-125"></i>
                        <div>
                            <h4 class="text-xl font-semibold">100% Satisfacción</h4>
                            <p class="text-sm text-gray-400">Clientes satisfechos</p>
                        </div>
                    </div>

                </div>


                <!-- Botón CTA -->
                <a href="contactanos"
                    class="bg-gradient-to-r from-[#f36100] to-orange-600 text-white py-4 px-8 rounded-lg text-lg font-semibold shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out hover:from-orange-400 hover:to-orange-500"
                    data-aos="fade-up" data-aos-duration="400" data-aos-delay="600">
                    Ver demostración
                </a>
            </div>
        </div>
    </section>
  <!-- Mission Section -->
<section class="py-16 bg-secondary text-white">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Misión -->
            <div 
                class="bg-primary rounded-2xl shadow-2xl p-8 mx-10 lg:m-0 text-center transform transition-all duration-500 
                    hover:scale-105 active:scale-95 focus:scale-105 
                    hover:shadow-[#f36100]/50 active:shadow-[#f36100]/50 focus:shadow-[#f36100]/50
                    border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100]
                    group cursor-pointer"
                data-aos="fade-up" data-aos-duration="400" data-aos-delay="200">
                <div class="flex justify-center mb-6 text-tertiary">
                    <i class="fas fa-bullseye text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                </div>
                <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100] group-active:text-[#f36100] group-focus:text-[#f36100]">
                    Misión
                </h4>
                <p class="text-lg text-gray-200 opacity-90 font-light">
                    Empoderar a los gimnasios con herramientas tecnológicas que optimicen su gestión y mejoren la experiencia de sus clientes.
                </p>
            </div>

            <!-- Visión -->
            <div 
                class="bg-primary rounded-2xl shadow-2xl p-8 mx-10 lg:m-0 text-center transform transition-all duration-500 
                    hover:scale-105 active:scale-95 focus:scale-105 
                    hover:shadow-[#f36100]/50 active:shadow-[#f36100]/50 focus:shadow-[#f36100]/50
                    border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100]
                    group cursor-pointer"
                data-aos="fade-up" data-aos-duration="400" data-aos-delay="400">
                <div class="flex justify-center mb-6 text-tertiary">
                    <i class="fas fa-eye text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                </div>
                <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100] group-active:text-[#f36100] group-focus:text-[#f36100]">
                    Visión
                </h4>
                <p class="text-lg text-gray-200 opacity-90 font-light">
                    Ser líderes globales en soluciones SaaS para la industria del fitness y el bienestar.
                </p>
            </div>

            <!-- Valores -->
            <div 
                class="bg-primary rounded-2xl shadow-2xl p-8 mx-10 lg:m-0 text-center transform transition-all duration-500 
                    hover:scale-105 active:scale-95 focus:scale-105 
                    hover:shadow-[#f36100]/50 active:shadow-[#f36100]/50 focus:shadow-[#f36100]/50
                    border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100]
                    group cursor-pointer"
                data-aos="fade-up" data-aos-duration="400" data-aos-delay="600">
                <div class="flex justify-center mb-6 text-tertiary">
                    <i class="fas fa-heart text-6xl group-hover:-translate-y-2 group-active:-translate-y-2 group-focus:-translate-y-2 transition-transform duration-500"></i>
                </div>
                <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100] group-active:text-[#f36100] group-focus:text-[#f36100]">
                    Valores
                </h4>
                <p class="text-lg text-gray-200 opacity-90 font-light">
                    Innovación constante, soporte excepcional y compromiso con el éxito de nuestros clientes.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- Team Section -->
<section class="pt-16 bg-primary text-white" data-aos="fade-up" data-aos-duration="400">
    <div class="container mx-auto text-center">
        <div class="section-title mb-12">
            <span class="uppercase text-tertiary font-semibold text-lg animate__animated animate__fadeIn animate__delay-0.5s">Conoce al Equipo</span>
            <h2 class="text-4xl font-bold mb-8 text-white animate__animated animate__fadeIn animate__delay-1s">Nuestros Expertos</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-16 justify-center mx-8 lg:m-0 ">
            <!-- Miembro 1 -->
            <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 hover:scale-105 active:scale-95 focus:scale-105 hover:shadow-xl hover:shadow-[#f36100]/50 active:shadow-[#f36100]/50 focus:shadow-[#f36100]/50 border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100] group cursor-pointer"
                data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                <div class="bg-cover bg-center h-80 mb-6 rounded-2xl" style="background-image: url('img/team/carlos.jpg');"></div>
                <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100] group-active:text-[#f36100] group-focus:text-[#f36100]">
                    Carlos Mantilla
                </h4>
                <span class="text-lg font-semibold">CEO</span>
                <div class="tt-social mt-4">
                    <a href="https://github.com/CarlosMantillaC" class="text-white hover:text-[#f36100] transition-all duration-300">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                </div>
            </div>

            <!-- Miembro 2 -->
            <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 hover:scale-105 active:scale-95 focus:scale-105 hover:shadow-xl hover:shadow-[#f36100]/50 active:shadow-[#f36100]/50 focus:shadow-[#f36100]/50 border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100] group cursor-pointer"
                data-aos="fade-up" data-aos-delay="400" data-aos-duration="400">
                <div class="bg-cover bg-center h-80 mb-6 rounded-2xl" style="background-image: url('img/team/arturito.jpg');"></div>
                <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100] group-active:text-[#f36100] group-focus:text-[#f36100]">
                    David Aceros
                </h4>
                <span class="text-lg font-semibold">COO</span>
                <div class="tt-social mt-4">
                    <a href="https://github.com/AcerosDavid" class="text-white hover:text-[#f36100] transition-all duration-300">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                </div>
            </div>

            <!-- Miembro 3 -->
            <div class="bg-secondary rounded-2xl shadow-2xl p-8 text-center transform transition-all duration-500 hover:scale-105 active:scale-95 focus:scale-105 hover:shadow-xl hover:shadow-[#f36100]/50 active:shadow-[#f36100]/50 focus:shadow-[#f36100]/50 border-2 border-transparent hover:border-[#f36100] active:border-[#f36100] focus:border-[#f36100] group cursor-pointer"
                data-aos="fade-up" data-aos-delay="600" data-aos-duration="400">
                <div class="bg-cover bg-center h-80 mb-6 rounded-2xl " style="background-image: url('img/team/isaac.jpg');"></div>
                <h4 class="text-2xl font-extrabold mb-4 text-white group-hover:text-[#f36100] group-active:text-[#f36100] group-focus:text-[#f36100]">
                    Isaac Diaz
                </h4>
                <span class="text-lg font-semibold">CTO</span>
                <div class="tt-social mt-4">
                    <a href="https://github.com/isaacDiazR" class="text-white hover:text-[#f36100] transition-all duration-300">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
