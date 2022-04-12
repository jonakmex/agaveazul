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
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->description }}</td>
                    <td>
                        <a href="{{ route('unit.show', $row->id) }}" class="btn btn-xs text-teal mx-1" title="Show">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>
                        <a href="{{ route('unit.edit', $row->id) }}" class="btn btn-xs text-primary mx-1" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                       <span>
                         @livewire(
                            'unit-modal-delete-component', 
                            ['unitId'=>$row->id, 'unitDescription'=>$row->description], 
                            key('confirm-delete'.$row->id.'-'.$loop->iteration)
                         )
                       </span>
                    </td>
                </tr>
               
            @empty
                <tr>
                    <td class="text-center" colspan="3">No data</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    </div>
    <br><br>

</div>
