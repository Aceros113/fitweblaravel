<form method="POST"
    action="{{ route(class_basename($user) === 'Admin' ? 'admin.memberships.store' : 'receptionist.memberships.store') }}"
    class="space-y-4 sm:space-y-6"
    x-data="{
        type: 'Mensual',
        open: false,
        options: ['Mensual', 'Diaria', 'Quincenal', 'Trimestral', 'Anual'],
        startDate: '',
        finishDate: '',
        calculateFinishDate() {
            if (!this.startDate) return;

            const start = new Date(this.startDate);
            let end = new Date(start);

            switch (this.type) {
                case 'Mensual':
                    end.setMonth(end.getMonth() + 1);
                    break;
                case 'Diaria':
                    end.setDate(end.getDate() + 1);
                    break;
                case 'Quincenal':
                    end.setDate(end.getDate() + 15);
                    break;
                case 'Trimestral':
                    end.setMonth(end.getMonth() + 3);
                    break;
                case 'Anual':
                    end.setFullYear(end.getFullYear() + 1);
                    break;
            }

            this.finishDate = end.toISOString().split('T')[0];
        }
    }"
    x-init="calculateFinishDate()"
>
    @csrf

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Cédula del Usuario</label>
            <input type="text" name="user_id" required
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                    focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all"
                placeholder="Ingrese la cédula del usuario">
        </div>

        <!-- Tipo de membresía con dropdown -->
        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Tipo</label>
            <div class="relative">
                <button @click="open = !open" type="button"
                    class="w-full flex justify-between items-center py-2 px-3 bg-[#252525] text-white border border-gray-700 rounded-xl
                        hover:border-gray-600 focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]
                        transition-all duration-300 text-left"
                    :class="{ 'ring-2 ring-[#f36100]': open }">
                    <span x-text="type"></span>
                    <svg class="h-5 w-5 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute z-10 mt-1 w-full bg-[#252525] border border-gray-700 rounded-lg shadow-lg overflow-hidden">
                    <ul class="py-1">
                        <template x-for="option in options" :key="option">
                            <li>
                                <button type="button" @click="type = option; open = false; calculateFinishDate()"
                                    class="w-full px-4 py-2 text-left hover:bg-[#f36100] transition-colors duration-200">
                                    <span x-text="option"></span>
                                </button>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
            <input type="hidden" name="type" x-model="type">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Monto</label>
            <input type="number" step="0.01" name="amount" required
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                        focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all"
                placeholder="Ej: 150000">
        </div>

        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Descuento (%)</label>
            <input type="number" step="0.01" name="discount" value="0"
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                        focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all"
                placeholder="Ej: 10">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Fecha de inicio</label>
            <input type="date" name="start_date" required x-model="startDate" @change="calculateFinishDate"
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                        focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all">
        </div>

        <div class="space-y-1">
            <label class="block text-sm sm:text-base text-gray-300">Fecha de fin</label>
            <input type="date" name="finish_date" required x-model="finishDate"
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                        focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all">
        </div>
    </div>

    <div class="mt-2 text-sm text-gray-400" x-show="startDate && finishDate">
        La membresía estará activa desde el <span x-text="new Date(startDate).toLocaleDateString()"></span> hasta el <span x-text="new Date(finishDate).toLocaleDateString()"></span>.
    </div>

    <div class="flex justify-end gap-4 pt-4">
        <button type="button" @click="showCreateModal = false"
            class="px-4 py-2 border border-gray-500 text-gray-300 rounded hover:border-[#f36100] hover:text-[#f36100] transition-all">
            Cancelar
        </button>
        <button type="submit"
            class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition duration-300 transform hover:scale-105">
            Guardar Membresía
        </button>
    </div>
</form>

