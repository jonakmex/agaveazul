<?php

namespace App\Http\Livewire;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Livewire\Component;

class AssetFormCreateComponent extends Component
{
    public $type;
    public $description;
    public $unitId;
    public $types;

    private $useCaseFactory;
    private $requestFactory;
    private $createAssetUseCase;

    public function __construct()
    {
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->createAssetUseCase = $this->useCaseFactory->make(CREATE_ASSET_USE_CASE);
    }

    public function render()
    {
        return view('livewire.asset-form-create-component');
    }

    public function save()
    {
        $this->resetErrorBag();
        $createAssetRequest = $this->requestFactory->make(CREATE_ASSET_REQUEST, [
            'unitId' => $this->unitId,
            'description' => $this->description,
            'type' => $this->type
        ]);
        $this->createAssetUseCase->execute($createAssetRequest,  function ($response) {
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
