<div>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        @foreach($config['data'] as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
    <x-adminlte-input name="description" wire:model="description" wire:keyup="refresh"/>
    
</div>
