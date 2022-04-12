<div>
    <div>
        @if ($updated)
            <x-adminlte-alert theme="success" title="Success" dismissable>
                Updated Succesfully
            </x-adminlte-alert>
        @endif
    </div>

    <x-adminlte-card title="Edit Unit" theme="primary" class="elevation-1" header-class="bg-dark"
        footer-class="border-top rounded border-light">

        <x-adminlte-input name="description" placeholder="Description" wire:model="description"/>

        <x-slot name="footerSlot">
            <x-adminlte-button class="d-flex ml-auto" theme="primary" label="Edit" wire:click="update" />
        </x-slot>

    </x-adminlte-card>
</div>

