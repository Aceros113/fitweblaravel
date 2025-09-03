<div x-show="currentEditPayment">
    <form method="POST" :action="`/admin/payments/${currentEditPayment.id}`">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Monto -->
            <div class="space-y-1">
                <label for="amount" class="block text-sm font-medium text-gray-300 mb-1">Monto</label>
                <input type="number" step="0.01" name="amount" id="amount" x-model="currentEditPayment.amount"
                    required
                    class="w-full py-2 px-3 bg-[#252525] text-white border border-gray-700 rounded-xl
                    focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none 
                    transition-all duration-500 text-base">
            </div>
            <!-- Método de pago -->
            <div class="space-y-1" x-data="{ open: false }">
                <label class="block text-sm font-medium text-gray-300 mb-1">Método de pago</label>
                <div class="relative">
                    <button @click="open = !open" type="button"
                        class="w-full flex justify-between items-center py-2 px-3 bg-[#252525] text-white border border-gray-700 rounded-xl
            hover:border-gray-600 focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]
            transition-all duration-300 text-left"
                        :class="{ 'ring-2 ring-[#f36100]': open }">
                        <span
                            x-text="currentEditPayment.payment_method ? currentEditPayment.payment_method : 'Seleccione método'"></span>
                        <svg class="h-5 w-5 text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute z-10 mt-1 w-full bg-[#252525] border border-gray-700 rounded-lg shadow-lg overflow-hidden">
                        <ul class="py-1">
                            @foreach (['Efectivo', 'Bancolombia', 'Nequi', 'Daviplata'] as $method)
                                <li>
                                    <button type="button"
                                        @click="currentEditPayment.payment_method = '{{ $method }}'; open = false"
                                        class="w-full px-4 py-2 text-left hover:bg-[#f36100] capitalize">
                                        {{ ucfirst($method) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <input type="hidden" name="payment_method" :value="currentEditPayment.payment_method">
            </div>


            <!-- Fecha de pago -->
            <div class="space-y-1">
                <label for="date" class="block text-sm font-medium text-gray-300 mb-1">Fecha de pago</label>
                <input type="date" name="date" id="payment_date" x-model="currentEditPayment.date"
                    required
                    class="w-full py-2 px-3 bg-[#252525] text-white border border-gray-700 rounded-xl
                    focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none 
                    transition-all duration-500 text-base">
            </div>

            <!-- Usuario (solo lectura) -->
            <div class="space-y-1">
                <label for="user_name" class="block text-sm font-medium text-gray-300 mb-1">Usuario</label>
                <input type="text" id="user_name" readonly x-model="currentEditPayment.user_name"
                    class="w-full py-2 px-3 bg-[#252525] text-white border border-gray-700 rounded-xl cursor-not-allowed
                    focus:outline-none transition-all duration-500 text-base">
                <input type="hidden" name="user_id" x-model="currentEditPayment.user_id">
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4 pt-6">
            <button type="button" @click="showEditModal = false"
                class="px-4 py-2 border border-gray-500 text-gray-300 rounded hover:border-[#f36100] hover:text-[#f36100] transition-all">
                Cancelar
            </button>
            <button type="submit"
                class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition duration-300 transform hover:scale-105">
                Actualizar Pago
            </button>
        </div>
    </form>
</div>
