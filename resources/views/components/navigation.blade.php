<nav class="mt-2">
    <ul class="pagination">
        @if ($pageNumber == 1)
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <button type="button" class="page-link" wire:click="setPageNumber({{$prevPage}})"
                        wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;
                </button>
            </li>
        @endif

        @for ($i = 1;$i <= $totalPages;$i++)
            @if ($pageNumber == $i)
                <li class="page-item active" wire:key="paginator-{{$i}}" aria-current="page"><span
                            class="page-link">{{$i}}</span></li>
            @else
                <li class="page-item" wire:key="paginator-{{$i}}">
                    <button type="button" class="page-link" wire:click="setPageNumber({{ $i }})">{{ $i }}</button>
                </li>
            @endif
        @endfor

        @if ($nextPage)
            <li class="page-item">
                <button type="button" class="page-link" wire:click="setPageNumber('{{ $nextPage }}')"
                        wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;
                </button>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</nav>
