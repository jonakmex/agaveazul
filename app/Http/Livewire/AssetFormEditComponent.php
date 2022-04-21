<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;

class AssetFormEditComponent extends Component
{
    public $assetId;
    public $unitId;
    public $description;
    public $type;
    public $types;
    private $useCaseFactory;
    private $requestFactory;
    private $editAssetUseCase;

    public function __construct()
    {
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->editAssetUseCase = $this->useCaseFactory->make(EDIT_ASSET_USE_CASE);
    }

    public function render()
    {
        return view('livewire.asset-form-edit-component');
    }

    public function update()
    {
        $this->resetErrorBag();
        $editAssetRequest = $this->requestFactory->make(EDIT_ASSET_REQUEST, [
            'id' => $this->assetId,
            'description' => $this->description,
            'type' => $this->type
        ]);
        $this->editAssetUseCase->execute($editAssetRequest,  function ($response) {
            if(!$response->errors){
                return redirect()->route('asset.index', ['unitId' => $this->unitId]); 
            }
            else{
                foreach($response->errors as $error){
                    foreach($error as $field => $message){
                        $this->addError($field, __("messages.$message"));
                    }
                }
            }
        });
    }
}
