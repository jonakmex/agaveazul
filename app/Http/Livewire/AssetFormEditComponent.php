<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;

class AssetFormEditComponent extends Component
{
    const EDIT_ASSET_USE_CASE = 'App\Domains\Condo\UseCase\EditAssetUseCase';
    const EDIT_ASSET_REQUEST = 'App\Domains\Condo\Boundary\Input\EditAssetRequest';
    public $assetId;
    public $unitId;
    public $description;
    public $type;
    public $typeKey;
    public $success;
    public $types;
    private $useCaseFactory;
    private $requestFactory;
    private $editAssetUseCase;

    public function __construct()
    {
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->editAssetUseCase = $this->useCaseFactory->make(self::EDIT_ASSET_USE_CASE);
    }

    public function mount($asset, $types)
    {
        $this->assetId = $asset['id'];
        $this->unitId = $asset['unitId'];
        $this->description = $asset['description'];
        $this->type = $asset['type'];
        $this->typeKey = $asset['typeKey'];
        $this->types = $types;
    }

    public function render()
    {
        return view('livewire.asset-form-edit-component');
    }

    public function update()
    {
        $this->success = false;
        $editAssetRequest = $this->requestFactory->make(self::EDIT_ASSET_REQUEST, [
            'id' => $this->assetId,
            'description' => $this->description,
            'type' => $this->typeKey
        ]);
        $this->editAssetUseCase->execute($editAssetRequest,  function ($response) {
            if ($response->errors) {
                $errorMessages = [
                    'description.max' => $response->errors[0]['description']
                ];
                $this->success = false;
                $this->validate(['description' => 'max:100'], $errorMessages);
            } else {
                $this->success = true;
                $this->resetValidation();
            }
        });
    }
}
