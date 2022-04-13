<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfirmationModalComponent extends Component
{
    public $modalId;
    public $unitId;
    public $action;

    protected $listeners = ['unitSelected' => 'selectItem','actionCompleted' => 'actionCompleted'];


    public function render()
    {
        return view('livewire.confirmation-modal-component');
    }

    public function selectItem($unitId){
        $this->unidId = $unitId;
        $this->dispatchBrowserEvent('openConfirmationModal',['id'=>$unitId]);
    }

    public function confirm(){
        $this->emitUp($this->action,$this->unidId);
    }

    public function actionCompleted(){
        $this->dispatchBrowserEvent('closeConfirmationModal');
    }
}
