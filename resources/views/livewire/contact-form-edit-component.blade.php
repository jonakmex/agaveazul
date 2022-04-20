<div>
    <x-adminlte-card title="Edit Contact" theme="primary" class="elevation-1" header-class="bg-dark"
        footer-class="border-top rounded border-light">

        <x-adminlte-input name="name" placeholder="Name" wire:model="name" class="{{$errors->has('name') ? 'border-danger' : ''}}"/>
        <x-adminlte-input name="lastName" placeholder="Last Name" wire:model="lastName" class="{{$errors->has('lastName') ? 'border-danger' : ''}}"/>
        <x-adminlte-select name="type" class="mr-4" wire:model="typeKey" fgroup-class="col-md-6">
                {!! $types !!}
        </x-adminlte-select>

        <x-slot name="footerSlot">
            <x-adminlte-button class="d-flex ml-auto" theme="primary" label="Edit" wire:click="update" />
        </x-slot>

    </x-adminlte-card>
</div>
