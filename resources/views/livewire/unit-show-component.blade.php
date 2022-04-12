<div>
    <x-adminlte-card title="Unit - {{$unit['description']}}" theme="primary" class="elevation-1" header-class="bg-dark">

        <a href="{{ route('contact.index', ['unit_id' => $unit['id']]) }}">
            <x-adminlte-button theme="primary" label="Contacts" />
        </a>
        <a href="{{ route('asset.index', ['unitId' => $unit['id']]) }}">
            <x-adminlte-button theme="success" label="Assets" />
        </a>

    </x-adminlte-card>
</div>
