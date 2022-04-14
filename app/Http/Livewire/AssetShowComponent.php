<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AssetShowComponent extends Component
{
    public $asset;

    public function render()
    {
        return view('livewire.asset-show-component');
    }
}
