@if ($paginator->hasPages())
    <div class="simple-pagination">
        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
            <span>&lt;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">&lt;</a>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span>{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">&gt;</a>
        @else
            <span>&gt;</span>
        @endif
    </div>
@endif
