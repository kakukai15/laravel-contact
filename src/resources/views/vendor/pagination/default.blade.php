@if ($paginator->hasPages())
    <nav>
        <ul class="pagination" style="display:flex; list-style:none; gap:6px; padding:0;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"
                    style="color:#ccc; padding:4px 8px; border:1px solid #ccc;">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li style="border:1px solid #ccc;">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"
                        style="text-decoration:none; padding:4px 8px; color:#333; display:block;">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true" style="color:#ccc; padding:4px 8px; border:1px solid #ccc;">
                        <span>{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"
                                style="background:#333; color:#fff; padding:4px 8px; border:1px solid #333;">
                                <span>{{ $page }}</span>
                            </li>
                        @else
                            <li style="border:1px solid #ccc;">
                                <a href="{{ $url }}" style="text-decoration:none; padding:4px 8px; color:#333; display:block;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li style="border:1px solid #ccc;">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"
                        style="text-decoration:none; padding:4px 8px; color:#333; display:block;">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')"
                    style="color:#ccc; padding:4px 8px; border:1px solid #ccc;">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
