<div>
    <div class="w-25 ml-auto">
        <x-adminlte-input type="search" name="description" placeholder="Search..." wire:model="description"
        wire:input="$refresh" 
        autocomplete="off"/>
    </div>
    <div class="row">
      <x-adminlte-select name="selBasic" wire:input="$refresh" wire:model="numRecordsPerPage">
          <option value="">Num registros</option>
          <option value= 3 >3</option>
          <option value= 5 >5</option>   
      </x-adminlte-select>
      <x-adminlte-select name="selBasic" wire:input="$refresh" wire:model="pageNumber">
          <option value= 1 >1 </option>  
          <option value= 2 > 2</option>
      </x-adminlte-select>
      <x-adminlte-select name="selBasic" wire:input="$refresh" wire:model="orderDirection">
          <option value= "asc" >Ascendente</option>  
          <option value= "desc" >Descendente</option>
      </x-adminlte-select>
    </div>
    <div>
        <x-adminlte-datatable id="unit-table" class="elevation-1" :config="$config" :heads="$heads"
            head-theme="dark" striped bordered hoverable>
            @forelse($data as $row)
               <tr>
                    @foreach ($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
               </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="3">No data</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    </div>
   @for ($i = 1;$i<=$numberOfPages;$i++)
       <button wire:click="setPageNumber({{$i}})"> {{$i}}</button>
   @endfor
     @livewire('confirmation-modal-component',['modalId'=>'deleteUnitConfirmationModal','action'=>'deleteUnit'])
    <br><br>
</div>
