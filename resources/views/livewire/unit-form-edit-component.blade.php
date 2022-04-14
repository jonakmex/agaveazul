<div>
    <div>
        @if ($success)
            <x-adminlte-alert theme="success" title="Updated" dismissable>
                Updated Succesfully
            </x-adminlte-alert>
        @endif
    </div>

    <x-adminlte-card title="Edit Unit" theme="primary" class="elevation-1" header-class="bg-dark"
        footer-class="border-top rounded border-light">

        @if ($error)
            <x-adminlte-input name="description" placeholder="Description"    wire:model="description" class="border border-danger"/>
        @else
            <x-adminlte-input name="description" placeholder="Description" wire:model="description"/>
        @endif

        <x-slot name="footerSlot">
            <x-adminlte-button class="d-flex ml-auto" theme="primary" label="Edit" wire:click="update" />
        </x-slot>

    </x-adminlte-card>
</div>

