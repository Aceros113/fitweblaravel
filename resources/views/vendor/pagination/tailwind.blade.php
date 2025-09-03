@if ($paginator->hasPages())
    <nav role="navigation" class="flex items-center justify-between" aria-label="Pagination Navigation">
        <div class="flex justify-center flex-1">
            <div class="inline-flex space-x-1 rounded-xl bg-[#0A0A0A] px-4 py-2 border border-transparent">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="px-5 py-2 text-sm text-gray-500 bg-[#151515] rounded">Anterior</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-5 py-2 text-sm text-white bg-[#151515] hover:bg-[#f36100] rounded">Anterior</a>
                @endif

                {{-- Pagination Elements (Hidden on Mobile) --}}
                <div class="hidden sm:flex sm:space-x-1">
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="px-5 py-2 text-sm text-gray-500 rounded">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="px-5 py-2 text-sm font-semibold text-white bg-[#f36100] rounded">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-5 py-2 text-sm text-white bg-[#151515] hover:bg-[#f36100] rounded transition-all">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-5 py-2 text-sm text-white bg-[#151515] hover:bg-[#f36100] rounded">Siguiente</a>
                @else
                    <span class="px-5 py-2 text-sm text-gray-500 bg-[#151515] rounded">Siguiente></span>
                @endif
            </div>
        </div>
    </nav>
@endif