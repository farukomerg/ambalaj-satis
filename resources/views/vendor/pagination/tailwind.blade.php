@if ($paginator->hasPages())
    <nav class="pagination-shell" role="navigation" aria-label="Pagination Navigation">
        @if ($paginator->onFirstPage())
            <span class="pagination-link is-disabled">Geri</span>
        @else
            <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Geri</a>
        @endif

        <div class="pagination-pages">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="pagination-dots">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-link is-current">{{ $page }}</span>
                        @else
                            <a class="pagination-link" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Ileri</a>
        @else
            <span class="pagination-link is-disabled">Ileri</span>
        @endif
    </nav>
@endif
