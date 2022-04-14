<div>
    <div>
        @if ($success)
            <x-adminlte-alert theme="success" title="Success" dismissable>
                Created Succesfully
            </x-adminlte-alert>
        @endif
    </div>

    <x-adminlte-card title="Create Unit" theme="primary" class="elevation-1" header-class="bg-dark"
        footer-class="border-top rounded border-light">

      @if ($error)
        <x-adminlte-input name="description" placeholder="Description"    wire:model="description" class="border border-danger"/>
      @else
        <x-adminlte-input name="description" placeholder="Description" wire:model="description"/>
      @endif

        <x-slot name="footerSlot">
            <x-adminlte-button class="d-flex ml-auto" theme="primary" label="Create" wire:click="store" />
        </x-slot>

    </x-adminlte-card>
</div>
