<<<<<<< HEAD
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
=======
@if ($paginator->count() > 1)
    <ul class="pagination">
        <!-- Previous Page Link -->
>>>>>>> f2ee11625fc135d64f1c289551974e76ccecd4f0
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

<<<<<<< HEAD
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
=======
        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
>>>>>>> f2ee11625fc135d64f1c289551974e76ccecd4f0
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

<<<<<<< HEAD
            {{-- Array Of Links --}}
=======
            <!-- Array Of Links -->
>>>>>>> f2ee11625fc135d64f1c289551974e76ccecd4f0
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

<<<<<<< HEAD
        {{-- Next Page Link --}}
=======
        <!-- Next Page Link -->
>>>>>>> f2ee11625fc135d64f1c289551974e76ccecd4f0
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
@endif
