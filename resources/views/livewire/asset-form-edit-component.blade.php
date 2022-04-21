<div>
    <x-adminlte-card title="Edit Asset" theme="primary" class="elevation-1" header-class="bg-dark"
        footer-class="border-top rounded border-light">

        <div class="row">
            <x-adminlte-input name="description" placeholder="Description" wire:model="description" fgroup-class="col-md-6"/>

            <x-adminlte-select name="type" class="mr-4" wire:model="type" fgroup-class="col-md-6">
                {!! $types !!}
            </x-adminlte-select>
        </div>

        <x-slot name="footerSlot">
            <a href="{{route('asset.index',['unitId'=>$unitId])}}">
                <x-adminlte-button label="Back"/>
            </a>
            <x-adminlte-button class="ml-auto" theme="primary" label="Edit" wire:click="update" />
        </x-slot>

    </x-adminlte-card>
</div>
