@if ($paginator->hasPages())
<nav class="pagination" role="navigation" aria-label="Pagination">
    @if ($paginator->onFirstPage())
        <span class="disabled">&laquo; Précédent</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Précédent</a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant &raquo;</a>
    @else
        <span class="disabled">Suivant &raquo;</span>
    @endif
</nav>
@endif