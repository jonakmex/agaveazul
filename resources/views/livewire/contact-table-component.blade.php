<div>
    <div class="row">
        <x-adminlte-input type="search" name="name" placeholder="Name" wire:model="name"
        wire:input="$refresh" 
        autocomplete="off"/>
        <x-adminlte-input type="search" name="lastName" placeholder="Last name" wire:model="lastName"
        wire:input="$refresh" 
        autocomplete="off"/>

        <x-adminlte-select name="selBasic" wire:input="$refresh" wire:model="type">
          <option value="">All</option>
          <option value="PROPIETARIO">Propietario</option>
          <option value="ARRENDATARIO">Arrendatario</option>
          <option value="REP_LEGAL">Representante legal</option>
      </x-adminlte-select>
    </div>


    <x-adminlte-datatable id="table2" :heads="$heads" :config="$config" head-theme="dark" striped bordered hoverable>
        @foreach($data as $row)
          <tr>
            @foreach($row as $cell)
              <td>{!! $cell !!}</td>
            @endforeach
          </tr>
        @endforeach
    </x-adminlte-datatable>

    @livewire('confirmation-modal-component',['modalId'=>'deleteContactConfirmationModal','action'=>'deleteContact'])
</div>
