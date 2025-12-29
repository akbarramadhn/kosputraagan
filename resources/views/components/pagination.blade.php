@if ($paginator->hasPages())
<nav class="flex items-center gap-2">
    {{-- First --}}
    <a href="{{ $paginator->url(1) }}"
       class="rounded-md border px-3 py-2 text-gray-600 hover:bg-gray-100">
        «
    </a>

    {{-- Prev --}}
    <a href="{{ $paginator->previousPageUrl() ?? '#' }}"
       class="rounded-md border px-3 py-2 text-gray-600 hover:bg-gray-100 {{ $paginator->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
        ‹
    </a>

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                <a href="{{ $url }}"
                   class="rounded-md px-4 py-2 text-sm font-medium
                   {{ $page == $paginator->currentPage()
                        ? 'bg-blue-600 text-white'
                        : 'border text-gray-700 hover:bg-gray-100' }}">
                    {{ $page }}
                </a>
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    <a href="{{ $paginator->nextPageUrl() ?? '#' }}"
       class="rounded-md border px-3 py-2 text-gray-600 hover:bg-gray-100 {{ !$paginator->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
        ›
    </a>

    {{-- Last --}}
    <a href="{{ $paginator->url($paginator->lastPage()) }}"
       class="rounded-md border px-3 py-2 text-gray-600 hover:bg-gray-100">
        »
    </a>
</nav>
@endif
