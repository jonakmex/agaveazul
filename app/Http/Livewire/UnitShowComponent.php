<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UnitShowComponent extends Component
{
    public $unitId;
    public $description;

    public function render()
    {
        return view('livewire.unit-show-component');
    }
}
