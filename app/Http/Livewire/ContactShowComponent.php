<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactShowComponent extends Component
{
    public $contact;

    public function mount($contact){
        $this->contact = $contact;
    }
    public function render()
    {
        return view('livewire.contact-show-component');
    }
}
