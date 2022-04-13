<div>
    <x-adminlte-modal  id="{{$modalId}}" title="Confirmation">
        Are you sure you want to delete?
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" label="Cancel" data-dismiss="modal"/>
            <x-adminlte-button theme="danger" label="Delete" wire:click="confirm"/>
        </x-slot>
    </x-adminlte-modal>
    <script>
        window.addEventListener('openConfirmationModal', event => {
            $("#{{$modalId}}").modal('show');
        })

        window.addEventListener('closeConfirmationModal', event => {
            $("#{{$modalId}}").modal('hide');
        })
    </script>
</div>
