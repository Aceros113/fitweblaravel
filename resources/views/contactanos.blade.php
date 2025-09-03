@extends('layouts.app')

@section('content')
    <title>FitWeb Contactanos</title>

    <!-- Breadcrumb Section Begin -->
    <section class="relative bg-cover bg-center py-50" style="background-image: url('/img/breadcrumb-bg.jpg')"
        data-aos="fade-in">
        <!-- Overlay negro con opacidad -->
        <div class="absolute inset-0 bg-black/70"></div>

        <div class="container relative z-10 mx-auto px-4 text-center">
            <h2 class="text-6xl font-extrabold text-white mb-6">Contáctanos</h2>
            <div class="text-white space-x-2 text-lg">
                <a href="/" class="hover:underline transition-all">Inicio</a>
                <span>></span>
                <span class="text-tertiary">Contáctanos</span>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="py-20 bg-gradient-to-b from-[#151515] via-[#1c1c1c] to-[#151515] relative overflow-hidden"
        data-aos="fade-up">
        <div class="absolute top-0 left-0 w-72 h-72 bg-[#f36100]/20 rounded-full blur-3xl opacity-30 animate-pulse -z-10">
        </div>
        <div
            class="absolute bottom-0 right-0 w-72 h-72 bg-[#f36100]/20 rounded-full blur-3xl opacity-30 animate-pulse delay-2000 -z-10">
        </div>

        <div class="container mx-auto text-center px-6">
            <div class="mb-14" data-aos="fade-down">
                <h2 class="text-4xl md:text-5xl font-extrabold text-[#f36100] mb-6 tracking-wide drop-shadow-lg">Contáctanos
                </h2>
                <p class="text-lg md:text-xl text-gray-300 leading-relaxed">¡Nos encantaría saber de ti! Llena el formulario
                    y da el primer paso.</p>
            </div>

            <div class="flex justify-center">
                <div class="w-full max-w-lg">
                    <div class="bg-[#1f1f1f] p-10 rounded-3xl shadow-2xl border border-gray-700 backdrop-blur-md"
                        data-aos="zoom-in">
                        <form id="contactForm" action="https://formspree.io/f/xblolwzo" method="POST" class="space-y-6">
                            <div>
                                <input type="text" name="name" required
                                    class="w-full p-4 bg-[#252525] text-white border border-gray-700 rounded-xl
                              focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none 
                              transition-all duration-500 placeholder-gray-400 text-base"
                                    placeholder="Tu Nombre">
                            </div>

                            <div>
                                <input type="email" name="email" required
                                    class="w-full p-4 bg-[#252525] text-white border border-gray-700 rounded-xl
                              focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none 
                              transition-all duration-500 placeholder-gray-400 text-base"
                                    placeholder="Correo Electrónico">
                            </div>

                            <div>
                                <input type="text" name="numero"
                                    class="w-full p-4 bg-[#252525] text-white border border-gray-700 rounded-xl
                              focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none 
                              transition-all duration-500 placeholder-gray-400 text-base"
                                    placeholder="Número de Teléfono">
                            </div>

                            <div>
                                <textarea name="comment" rows="4"
                                    class="w-full p-4 bg-[#252525] text-white border border-gray-700 rounded-xl
                              focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none 
                              transition-all duration-500 placeholder-gray-400 text-base"
                                    placeholder="Tu Mensaje"></textarea>
                            </div>

                            <button type="submit" id="submitButton"
                                class="flex justify-center items-center gap-2 w-full py-4 bg-gradient-to-r from-[#f36100] to-[#ff7300] text-white rounded-xl text-lg font-semibold
                          hover:scale-105 hover:from-[#e05500] hover:to-[#e05500] focus:outline-none focus:ring-4 focus:ring-[#f36100]/70 transition-all duration-300 relative">
                                <span id="buttonText">Enviar Mensaje</span>
                                <span id="spinner"
                                    class="hidden animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-white"></span>
                            </button>

                            <!-- Mensaje de éxito oculto -->
                            <p id="successMessage" class="text-green-400 mt-6 hidden text-center text-sm animate-bounce">
                                ¡Mensaje enviado correctamente!</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        const form = document.getElementById('contactForm');
        const successMessage = document.getElementById('successMessage');
        const submitButton = document.getElementById('submitButton');
        const spinner = document.getElementById('spinner');
        const buttonText = document.getElementById('buttonText');

        form.addEventListener('submit', async function(event) {
            event.preventDefault(); // Evita recargar la página

            // Mostrar spinner y desactivar botón
            spinner.classList.remove('hidden');
            buttonText.classList.add('hidden');
            submitButton.disabled = true;

            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    form.reset();
                    successMessage.classList.remove('hidden');

                    setTimeout(() => {
                        window.location.href = '/contactanos'; // Tu página de gracias
                    }, 2500);
                } else {
                    alert('Algo salió mal. El formulario no pudo enviarse.');
                }
            } catch (error) {
                alert('Error en la conexión. Inténtalo más tarde.');
            } finally {
                // Ocultar spinner y reactivar botón (por si hay error)
                spinner.classList.add('hidden');
                buttonText.classList.remove('hidden');
                submitButton.disabled = false;
            }
        });
    </script>
@endsection
