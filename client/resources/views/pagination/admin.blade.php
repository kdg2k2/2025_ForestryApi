<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 40px;
    }

    li {
        margin-right: 5px !important;
    }

    .pagination .page-link {
        border: none;
        background: #EDF3F8;
        color: #01002A;
        margin: 0 10px;
        border-radius: 0px !important;
        width: 40px;
        height: 40px;
        line-height: 28px;
        text-align: center;
        transition: all .5s ease-in-out;
    }

    .pagination .page-link:hover,
    .pagination .page-item.active .page-link {
        background: #659494;
        color: #fff !important;
    }

    .disabled {
        pointer-events: none;
        cursor: default;
    }
</style>

<div aria-label="Page navigation">
    @if ($paginator->hasPages())
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link" href="javascript:void(0)">
                        <i class="iconly-Arrow-Left icli"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       aria-label="@lang('pagination.previous')">
                        <i class="iconly-Arrow-Left icli"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled page-item" aria-disabled="true">
                        <a class="page-link disabled" href="javascript:void(0)">
                            {{ $element }}
                        </a>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a class="page-link disabled" href="javascript:void(0)">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="iconly-Arrow-Right icli"></i>
                    </a>
                </li>
            @else
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="page-link" href="javascript:void(0)">
                        <i class="iconly-Arrow-Right icli"></i>
                    </a>
                </li>
            @endif
        </ul>
    @endif
</div>
