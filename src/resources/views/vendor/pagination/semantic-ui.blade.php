@if ($paginator->hasPages())
<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="disabled" aria-disabled="true"><span>&lt;</span></li> {{-- ここを「<」に変更 --}}
    @else
    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a></li> {{-- ここを「<」に変更 --}}
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a></li> {{-- ここを「>」に変更 --}}
    @else
    <li class="disabled" aria-disabled="true"><span>&gt;</span></li> {{-- ここを「>」に変更 --}}
    @endif
</ul>
@endif