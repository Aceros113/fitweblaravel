<div x-data="{ showConfirm: false }">
    <button type="button" @click="showConfirm = true"
        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition duration-300">
        Eliminar
    </button>

    <div x-show="showConfirm" x-cloak x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="bg-[#151515] p-6 rounded-xl shadow-xl border border-gray-600 w-full max-w-sm text-center relative">
            <div class="text-red-500 text-4xl mb-4">⚠️</div>
            <h2 class="text-lg font-semibold text-white mb-2">¿Estás seguro?</h2>
            <p class="text-gray-400 text-sm mb-6">Esta acción no se puede deshacer. El usuario será eliminado permanentemente.</p>

            <div class="flex justify-center gap-4 mt-4">
                <button @click="showConfirm = false"
                    class="px-4 py-2 border border-gray-500 text-gray-300 rounded hover:border-[#f36100] hover:text-[#f36100] transition-all">
                    Cancelar
                </button>

                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white hover:text-[#0A0A0A] rounded transition-all">
                        Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
