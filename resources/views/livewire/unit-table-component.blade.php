<div>
    <div class="w-25 ml-auto">
        <x-adminlte-input type="search" name="description" placeholder="Search..." wire:model="description"
        wire:input="$refresh" 
        autocomplete="off"/>
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
     @livewire('confirmation-modal-component',['modalId'=>'deleteUnitConfirmationModal','action'=>'deleteUnit'])
    <br><br>
</div>
