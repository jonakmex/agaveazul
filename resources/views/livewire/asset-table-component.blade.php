<div>
    <div class="w-25 ml-auto d-flex">
        <x-adminlte-select name="type" class="mr-4" wire:model="type" wire:change="$refresh">
            <option value="">All</option>
            {!! $types !!}
        </x-adminlte-select>

        <x-adminlte-input type="search" name="description" placeholder="Search..." wire:model="description"
        wire:input="$refresh" 
        autocomplete="off"/>
    </div>

    <div>
        <x-adminlte-datatable id="asset-table" class="elevation-1" :config="$config" :heads="$heads"
            head-theme="dark" striped bordered hoverable>
            @forelse($data as $row)
               <tr>
                    @foreach ($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
               </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="4">No data</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    </div>
     @livewire('confirmation-modal-component',['modalId'=>'deleteAssetConfirmationModal','action'=>'deleteAsset'])
    <br><br>
</div>
