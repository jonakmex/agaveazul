<?php

namespace App\Http\Livewire;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Livewire\Component;

class AssetFormCreateComponent extends Component
{
    const CREATE_ASSET_USE_CASE = 'App\Domains\Condo\UseCase\CreateAssetUseCase';
    const CREATE_ASSET_REQUEST = 'App\Domains\Condo\Boundary\Input\CreateAssetRequest';
    public $type;
    public $description;
    public $unitId;
    public $types;

    public $error;
    public $success;

    private $useCaseFactory;
    private $requestFactory;
    private $createAssetUseCase;


    public function __construct()
    {
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->createAssetUseCase = $this->useCaseFactory->make(self::CREATE_ASSET_USE_CASE);
    }

    public function render()
    {
        return view('livewire.asset-form-create-component');
    }

    public function store()
    {
        $this->success = false;
        $createAssetRequest = $this->requestFactory->make(self::CREATE_ASSET_REQUEST, [
            'unitId' => $this->unitId,
            'description' => $this->description,
            'type' => $this->type
        ]);
        $this->createAssetUseCase->execute($createAssetRequest,  function ($response) {
            if($response->errors ){
                $this->success = false;
                $this->error = true;
                $errorMessages = [
                    'description.required' => $response->errors[0]['description'] ?? '',
                    'description.max' => $response->errors[0]['description'] ?? '',
                    'type.required' => $response->errors[1]['type'] ?? $response->errors[0]['type'] ?? ''
                ];
                $this->validate(['description'=>'required|max:100', 'type' => 'required'], $errorMessages);
            } else {
                $this->success = true;
                $this->error = false;
                $this->resetValidation();
                $this->reset('description', 'type');
            }
        });

    }
}
