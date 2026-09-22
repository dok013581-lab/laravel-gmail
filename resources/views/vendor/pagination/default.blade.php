@if ($paginator->hasPages())

<style>
    .tm-pagination {
        margin-top: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        font-size: 14px;
    }

    .tm-pagination-info {
        color: #6b7280;
        white-space: nowrap;
    }

    .tm-pagination-info strong {
        color: #111827;
    }

    .tm-pagination-links {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .tm-pagination-links a,
    .tm-pagination-links span {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 8px;
        font-size: 14px !important;
        line-height: 1 !important;
        text-decoration: none;
        box-sizing: border-box;
    }

    .tm-pagination-links a {
        color: #2563eb;
        background: #ffffff;
        border: 1px solid #e5e7eb;
    }

    .tm-pagination-links a:hover {
        background: #eff6ff;
        border-color: #93c5fd;
    }

    .tm-pagination-links .tm-current {
        color: #ffffff;
        background: #2563eb;
        border: 1px solid #2563eb;
    }

    .tm-pagination-links .tm-disabled {
        color: #9ca3af;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        cursor: default;
    }

    @media (max-width: 768px) {
        .tm-pagination {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<nav class="tm-pagination" role="navigation" aria-label="{{ __('Pagination Navigation') }}">

    <div class="tm-pagination-info">
        @if ($paginator->firstItem())
            Hiển thị <strong>{{ $paginator->firstItem() }}</strong>–<strong>{{ $paginator->lastItem() }}</strong>
            trong <strong>{{ $paginator->total() }}</strong> kết quả
        @else
            {{ $paginator->count() }} kết quả
        @endif
    </div>

    <div class="tm-pagination-links">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="tm-disabled" aria-disabled="true">
                &laquo; Trước
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                &laquo; Trước
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)

            @if (is_string($element))
                <span class="tm-disabled" aria-disabled="true">
                    {{ $element }}
                </span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())
                        <span class="tm-current" aria-current="page">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}">
                            {{ $page }}
                        </a>
                    @endif

                @endforeach
            @endif

        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                Tiếp &raquo;
            </a>
        @else
            <span class="tm-disabled" aria-disabled="true">
                Tiếp &raquo;
            </span>
        @endif

    </div>
</nav>

@endif