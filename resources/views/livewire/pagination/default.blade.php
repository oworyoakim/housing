@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="Previous">
                    <a href="javascript:void(0);" class="page-link">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);" wire:click="previousPage" rel="prev"
                       aria-label="Previous">&laquo;</a>
                </li>
            @endif

            {{--            Current Page Element--}}
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="javascript:void(0);">
                    <span>{{ $paginator->currentPage() }}</span>
                </a>
            </li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);" wire:click="nextPage" rel="next"
                       aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="Next">
                    <a class="page-link">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
