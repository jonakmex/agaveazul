<div>
    <x-adminlte-card title="Create Asset" theme="primary" class="elevation-1" header-class="bg-dark"
        footer-class="border-top rounded border-light">

        <div class="row">
            <x-adminlte-input name="description" placeholder="Description" wire:model="description" fgroup-class="col-md-6" class="{{$errors->has('description') ? 'border-danger' : '' }}"/>

            <x-adminlte-select name="type" class="mr-4" wire:model="type" fgroup-class="col-md-6" class="{{$errors->has('type') ? 'border-danger' : '' }}">
                <option value="" hidden>Select type</option>
                {!! $types !!}
            </x-adminlte-select>
        </div>

        <x-slot name="footerSlot">
            <a href="{{route('asset.index',['unitId'=>$unitId])}}">
                <x-adminlte-button label="Back"/>
            </a>
            <x-adminlte-button class="ml-auto" theme="primary" label="Create" wire:click="save" />
        </x-slot>

    </x-adminlte-card>
</div>

