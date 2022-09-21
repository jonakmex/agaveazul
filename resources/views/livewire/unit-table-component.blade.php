<div>
    <div class="w-25 ml-auto">
        <x-adminlte-input type="search" name="description" placeholder="Search..." wire:model="description"
                          wire:input="$refresh"/>
    </div>
    <div class="row">
        <x-adminlte-select name="perPage" wire:change="setPageNumber(1)" wire:model="perPage">
            <option value="10">10</option>
            <option value="100">100</option>
            <option value="{{$totalUnits}}">All</option>
        </x-adminlte-select>
        <x-adminlte-select name="orderDirection" wire:change="setPageNumber(1)" wire:model="orderDirection">
            <option value="asc">Ascendente</option>
            <option value="desc">Descendente</option>
        </x-adminlte-select>
    </div>
    <div>
        <x-adminlte-datatable id="unit-table" class="elevation-1" :config="$config" :heads="$heads"
                              head-theme="dark" striped bordered hoverable>
            @forelse($data as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="3">No data</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    </div>

    <nav>
        <ul class="pagination">
            @if ($pageNumber == 1)
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <button type="button" class="page-link" wire:click="setPageNumber({{$prevPage}})" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</button>
                </li>
            @endif

            @for ($i = 1;$i <= $totalPages;$i++)
                @if ($pageNumber == $i)
                    <li class="page-item active" wire:key="paginator-{{$i}}" aria-current="page"><span class="page-link">{{$i}}</span></li>
                @else
                    <li class="page-item" wire:key="paginator-{{$i}}"><button type="button" class="page-link" wire:click="setPageNumber({{ $i }})">{{ $i }}</button></li>
                @endif
            @endfor

            @if ($nextPage)
                <li class="page-item">
                    <button type="button" class="page-link" wire:click="setPageNumber('{{ $nextPage }}')" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</button>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
    @livewire('confirmation-modal-component',['modalId'=>'deleteUnitConfirmationModal','action'=>'deleteUnit'])
    <br><br>
</div>
