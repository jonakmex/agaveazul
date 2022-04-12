<div class="d-inline">
     <button class="btn btn-xs text-danger mx-1" data-toggle="modal" data-target="#modal-confirm-{{ $unitId }}">
        <i class="fa fa-lg fa-fw fa-trash"></i>
    </button>
   
    <x-adminlte-modal id="modal-confirm-{{ $unitId }}" title="Delete unit" v-centered>
        <div>
            <p class="d-block text-center"> Are you sure you want to delete Unit <br>
                    {{$unitDescription}}?
            </p>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="secondary" label="Cancel" data-dismiss="modal" />
            <x-adminlte-button class="ml-auto" theme="danger" label="Delete"
                wire:click="delete" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
</div>
