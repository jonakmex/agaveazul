<div>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        @foreach($data as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
    @livewire('confirmation-modal-component',['modalId'=>'deleteUnitConfirmationModal','action'=>'deleteUnit'])
</div>
