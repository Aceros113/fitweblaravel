<form method="POST" 
    action="{{ route('admin.attendance-users.store') }}"
    class="space-y-4 sm:space-y-6"
    x-data="{
        currentTime: {
            date: '',
            check_in: '',
            check_out: ''
        },
        getCurrentTime() {
            const now = new Date();
            
            // Formatear fecha (YYYY-MM-DD)
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            this.currentTime.date = `${year}-${month}-${day}`;
            
            // Formatear hora (HH:MM)
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeString = `${hours}:${minutes}`;
            
            
            // Actualizar inputs del formulario
            document.getElementById('date').value = this.currentTime.date;
            document.getElementById('check_in').value = this.currentTime.check_in;
            document.getElementById('check_out').value = this.currentTime.check_out;
            
            return this.currentTime;
        },
        setCurrentTime(field) {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeString = `${hours}:${minutes}`;
            
            // Actualizar solo el campo específico
            this.currentTime[field] = timeString;
            document.getElementById(field).value = timeString;
        }
    }"
    x-init="currentTime.date = new Date().toISOString().split('T')[0]"
>
    @csrf

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">

        <!-- ID de usuario -->
        <div class="space-y-1">
            <label for="user_id" class="block text-sm sm:text-base text-gray-300">Cédula del Usuario</label>
            <input type="text" name="user_id" id="user_id" required
                value="{{ session('user_id') }}"
                class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                    focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all"
                placeholder="Ingrese la cédula del usuario">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        <!-- Fecha -->
        <div class="space-y-1">
            <label for="date" class="block text-sm sm:text-base text-gray-300">Fecha</label>
            <div class="relative">
                <input type="date" name="date" id="date" required
                    x-model="currentTime.date"
                    class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                    focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all">
                <button type="button" @click="getCurrentTime()"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-[#f36100]">
                    ⏱
                </button>
            </div>
        </div>

        <!-- Hora Entrada -->
        <div class="space-y-1">
            <label for="check_in" class="block text-sm sm:text-base text-gray-300">Hora Entrada</label>
            <div class="relative">
                <input type="time" name="check_in" id="check_in" required
                    x-model="currentTime.check_in"
                    class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                    focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all">
                <button type="button" @click="setCurrentTime('check_in')"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-[#f36100]">
                    🕓
                </button>
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-4 pt-6">
        <button type="button" @click="showCreateModal = false"
            class="px-4 py-2 border border-gray-500 text-gray-300 rounded hover:border-[#f36100] hover:text-[#f36100] transition-all">
            Cancelar
        </button>
        <button type="submit"
            class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition duration-300">
            Registrar Asistencia
        </button>
    </div>
</form>