<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfirmationComponent extends Component
{
    public $unitId;

    public function render()
    {
        return view('livewire.confirmation-component');
    }
}
