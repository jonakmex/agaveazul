<div>
    <div class="w-100 d-flex">
        <div class="d-inline-flex align-items-center mr-2">
            <span class="mr-2"> Showing </span>
            <x-adminlte-select name="perPage" wire:change="setPageNumber(1)" wire:model="perPage">
                <option value="10">10</option>
                <option value="100">100</option>
                <option value="{{$totalUnits}}">All</option>
            </x-adminlte-select>
            <span class="ml-2">per page</span>
        </div>
        <x-adminlte-select name="orderDirection" wire:change="setPageNumber(1)" wire:model="orderDirection">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </x-adminlte-select>
        <x-adminlte-input class="ml-auto" type="search" name="description" placeholder="Search..."
                          wire:model="description"
                          wire:input="setPageNumber(1)"/>
    </div>
    <div style="max-height: 500px; overflow-y: scroll">

        <div class="table-responsive elevation-1">
            <table class="w-100 table table-bordered table-hover table-striped table-sm">
                <thead class="thead-dark">
                @foreach($heads as $th)
                    <th @isset($th['width']) style="width:{{ $th['width'] }}%" @endisset
                    @isset($th['no-export']) dt-no-export @endisset>
                        {{ is_array($th) ? ($th['label'] ?? '') : $th }}
                    </th>
                @endforeach
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>

    <x-navigation :pageNumber="$pageNumber" :nextPage="$nextPage" :totalPages="$totalPages" :prevPage="$prevPage"/>

    @livewire('confirmation-modal-component',['modalId'=>'deleteUnitConfirmationModal','action'=>'deleteUnit'])
    <br><br>
</div>
