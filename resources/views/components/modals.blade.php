{{-- Encabezado con botón --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <h1 class="text-3xl lg:text-4xl font-extrabold text-[#f36100] transition-all duration-300">
        {{ $title }} - <span class="text-white">{{ $subtitle }}</span>
    </h1>
    <button @click="{{ $createShowVar }} = true"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow w-full md:w-auto text-center">
        + {{ $buttonText }}
    </button>
</div>

{{-- Modal Crear --}}
<div x-show="{{ $createShowVar }}" x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm"
    @click="{{ $createShowVar }} = false">
</div>

<div x-show="{{ $createShowVar }}" x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-50 flex items-center justify-center p-4"
    @keydown.escape.window="{{ $createShowVar }} = false">
    <div class="bg-[#151515] w-full max-w-2xl rounded-lg shadow-xl overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-gray-700">
            <h2 class="text-3xl font-bold text-tertiary">{{ $createTitle }}</h2>
            <button @click="{{ $createShowVar }} = false"
                class="flex items-center justify-center w-10 h-10 rounded-full bg-[#0A0A0A] text-white transition duration-300 transform hover:bg-[#f36100] hover:scale-110 hover:rotate-12">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>
        <div class="p-6 overflow-y-auto max-h-[80vh]">
            @include($createView, $createParams ?? [])
        </div>
    </div>
</div>


{{-- Modal Editar --}}
<div x-show="{{ $editShowVar }}"  x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm"
    @click="{{ $editShowVar }} = false">
</div>

<div x-show="{{ $editShowVar }}"  x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-50 flex items-center justify-center p-6"
    @keydown.escape.window="{{ $editShowVar }} = false">
    <div class="bg-[#151515] w-full max-w-2xl rounded-lg shadow-xl overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-gray-700">
            <h2 class="text-3xl font-bold text-tertiary">{{ $editTitle }}</h2>
            <button @click="{{ $editShowVar }} = false"
    class="flex items-center justify-center w-10 h-10 rounded-full bg-[#0A0A0A] text-white transition duration-300 transform hover:bg-[#f36100] hover:scale-110 hover:rotate-12">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

        </div>
        <div class="p-4 overflow-y-auto max-h-[80vh]">
            <div x-show="{{ $editCondition }}" x-transition>
                @include($editView, $editParams ?? [])
            </div>
        </div>
    </div>
</div>
