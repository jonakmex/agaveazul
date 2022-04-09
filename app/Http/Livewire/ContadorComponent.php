<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContadorComponent extends Component
{

    public $counter = 0;

    public function render()
    {
        return view('livewire.contador-component');
    }

    public function clickMe(){
        $this->counter++;
    }
}
