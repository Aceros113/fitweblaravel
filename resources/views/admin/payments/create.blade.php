<form method="POST" action="{{ route(class_basename($user) === 'Admin' ? 'admin.payments.store' : 'receptionist.payments.store') }}" class="space-y-4 sm:space-y-6">
    @csrf

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">

        <!-- ID de usuario -->
        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Cédula del Usuario</label>
            <input type="text" name="user_id" required
                value="{{ session('user_id') }}"
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                    focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all"
                placeholder="Ingrese la cédula del usuario">
        </div>

        <!-- ID de membresía -->
        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">ID de Membresía</label>
            <input type="text" name="membership_id" required
                value="{{ session('membership_id') }}"
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                    focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all"
                placeholder="ID de la membresía correspondiente">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
        <!-- Fecha del pago -->
        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Fecha</label>
            <input type="date" name="date" required
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all">
        </div>

        <!-- Método de pago -->
        <div class="space-y-1" x-data="{ method: 'Efectivo', open: false, options: ['Efectivo', 'Bancolombia', 'Nequi', 'Daviplata'] }">
            <label class="block text-sm sm:text-base text-gray-300">Método de pago</label>
            <div class="relative">
                <button @click="open = !open" type="button"
                    class="w-full flex justify-between items-center py-2 px-3 bg-[#252525] text-white border border-gray-700 rounded-xl
                    hover:border-gray-600 focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]
                    transition-all duration-300 text-left"
                    :class="{ 'ring-2 ring-[#f36100]': open }">
                    <span x-text="method"></span>
                    <svg class="h-5 w-5 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute z-10 mt-1 w-full bg-[#252525] border border-gray-700 rounded-lg shadow-lg overflow-hidden">
                    <ul class="py-1">
                        <template x-for="option in options" :key="option">
                            <li>
                                <button type="button" @click="method = option; open = false"
                                    class="w-full px-4 py-2 text-left hover:bg-[#f36100] transition-colors duration-200">
                                    <span x-text="option"></span>
                                </button>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
            <input type="hidden" name="payment_method" x-model="method">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
        <!-- Monto -->
        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Monto</label>
            <input type="number" step="0.01" name="amount" required
                value="{{ session('amount') }}"
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all"
                placeholder="Ej: 150000">
        </div>
    </div>

    <!-- Botones -->
    <div class="flex justify-end gap-4 pt-4">
        <button type="button" @click="showCreateModal = false"
            class="px-4 py-2 border border-gray-500 text-gray-300 rounded hover:border-[#f36100] hover:text-[#f36100] transition-all">
            Cancelar
        </button>
        <button type="submit"
            class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition duration-300 transform hover:scale-105">
            Guardar Pago
        </button>
    </div>
</form>
