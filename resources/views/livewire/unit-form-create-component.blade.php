<div>
    <div>
        @if ($created)
            <x-adminlte-alert theme="success" title="Success" dismissable>
                Created Succesfully
            </x-adminlte-alert>
        @endif
    </div>

    <x-adminlte-card title="Create Unit" theme="primary" class="elevation-1" header-class="bg-dark"
        footer-class="border-top rounded border-light">

        <x-adminlte-input name="description" placeholder="Description" wire:model="description"/>

        <x-slot name="footerSlot">
            <x-adminlte-button class="d-flex ml-auto" theme="primary" label="Create" wire:click="save" />
        </x-slot>

    </x-adminlte-card>
</div>
