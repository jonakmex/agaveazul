<div>

    <x-adminlte-card title="Create Contact" theme="primary" class="elevation-1" header-class="bg-dark"
        footer-class="border-top rounded border-light">

        <x-adminlte-input name="name" placeholder="Name" wire:model="name" class="{{$errors->has('name') ? 'border-danger' : ''}}"/>
        <x-adminlte-input name="lastName" placeholder="Last Name" wire:model="lastName" class="{{$errors->has('lastName') ? 'border-danger' : ''}}"/>
        <x-adminlte-select name="selBasic" wire:model="type">
            <option value="PROPIETARIO">Propietario</option>
            <option value="ARRENDATARIO">Arrendatario</option>
            <option value="REP_LEGAL">Representante legal</option>
        </x-adminlte-select>
        

        <x-slot name="footerSlot">
            <x-adminlte-button class="d-flex ml-auto" theme="primary" label="Create" wire:click="save" />
        </x-slot>

    </x-adminlte-card>
</div>
