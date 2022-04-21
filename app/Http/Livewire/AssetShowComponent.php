<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AssetShowComponent extends Component
{
    public $assetId;
    public $description;
    public $type;
    public $unitId;

    public function render()
    {
        return view('livewire.asset-show-component');
    }
}
