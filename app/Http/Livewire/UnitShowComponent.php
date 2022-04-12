<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UnitShowComponent extends Component
{
    public $unit;

    public function mount($unit){
        $this->unit = $unit;
    }

    public function render()
    {
        return view('livewire.unit-show-component');
    }
}
