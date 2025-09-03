s<form method="POST" 
    action="{{ route('admin.attendance-users.update', $attendance->id) }}"
    class="space-y-4 sm:space-y-6"
    x-data="{
        currentTime: {
            check_out: ''
        },
        setCurrentTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeString = `${hours}:${minutes}`;
            
            this.currentTime.check_out = timeString;
            document.getElementById('check_out').value = timeString;
        }
    }"
>
    @if(!$attendance->user)
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            Error: El usuario asociado a esta asistencia no existe o ha sido eliminado.
            <div class="mt-2">
                <button @click="showEditModal = false" 
                    class="px-3 py-1 bg-white text-red-500 rounded hover:bg-gray-100">
                    Cerrar
                </button>
            </div>
        </div>
    @else
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <!-- Cédula del Usuario (solo lectura) -->
            <div class="space-y-1">
                <label class="block text-sm sm:text-base text-gray-300">Cédula del Usuario</label>
                <input type="text" value="{{ $attendance->user->id }}" readonly
                    class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700">
            </div>

            <!-- Nombre del Usuario (solo lectura) -->
            <div class="space-y-1">
                <label class="block text-sm sm:text-base text-gray-300">Nombre del Usuario</label>
                <input type="text" value="{{ $attendance->user->name }}" readonly
                    class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <!-- Fecha (solo lectura) -->
            <div class="space-y-1">
                <label class="block text-sm sm:text-base text-gray-300">Fecha</label>
                <input type="text" value="{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}" readonly
                    class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700">
            </div>

            <!-- Hora Entrada (solo lectura) -->
            <div class="space-y-1">
                <label class="block text-sm sm:text-base text-gray-300">Hora Entrada</label>
                <input type="text" value="{{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i') }}" readonly
                    class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700">
            </div>

            <!-- Hora Salida -->
            <div class="space-y-1">
                <label for="check_out" class="block text-sm sm:text-base text-gray-300">Hora Salida</label>
                <div class="relative">
                    <input type="time" name="check_out" id="check_out" required
                        x-model="currentTime.check_out"
                        class="w-full py-2 px-3 rounded-xl bg-[#252525] text-white border border-gray-700 
                        focus:border-[#f36100] focus:ring-2 focus:ring-[#f36100]/70 focus:outline-none transition-all">
                    <button type="button" @click="setCurrentTime()"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-[#f36100]">
                        🕓
                    </button>
                </div>
            </div>
        </div>

        <input type="hidden" name="user_id" value="{{ $attendance->user_id }}">
        <input type="hidden" name="date" value="{{ $attendance->date }}">
        <input type="hidden" name="check_in" value="{{ $attendance->check_in }}">

        <div class="flex justify-end gap-4 pt-6">
            <button type="button" @click="showEditModal = false"
                class="px-4 py-2 border border-gray-500 text-gray-300 rounded hover:border-[#f36100] hover:text-[#f36100] transition-all">
                Cancelar
            </button>
            <button type="submit"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-300">
                Registrar Salida
            </button>
        </div>
    @endif
</form>