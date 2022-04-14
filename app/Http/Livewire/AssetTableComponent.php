<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ViewModel\AssetVm;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Livewire\Component;

class AssetTableComponent extends Component
{
    const FIND_ASSETS_BY_CRITERIA_USE_CASE = "App\Domains\Condo\UseCase\FindAssetsByCriteriaUseCase";
    const DELETE_ASSET_USE_CASE = "App\Domains\Condo\UseCase\DeleteAssetUseCase";
    const DELETE_ASSET_REQUEST = "App\Domains\Condo\Boundary\Input\DeleteAssetRequest";
    const FIND_ASSETS_BY_CRITERIA_REQUEST = "App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest";

    public $config;
    public $data;
    public $heads;
    public $description;
    public $type;
    public $unitId;
    public $types;

    protected $queryString = [
        'description' => ['except' => ''],
        'type' => ['except' => '']
    ];

    private $requestFactory;
    private $useCaseFactory;
    private $findAssetsByCriteriaUseCase;
    private $deleteAssetUseCase;
    protected $listeners = ['deleteAsset'];

    public function __construct()
    {
        $this->requestFactory = app(RequestFactory::class);
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->findAssetsByCriteriaUseCase = $this->useCaseFactory->make(self::FIND_ASSETS_BY_CRITERIA_USE_CASE);
        $this->deleteAssetUseCase = $this->useCaseFactory->make(self::DELETE_ASSET_USE_CASE);
        $this->heads = [
            'ID',
            'Description',
            'Type',
            ['label' => 'Actions', 'no-export' => true, 'width' => '20']
        ];

        $this->config = [
            'ordering' => false,
            'paging' => false,
            'lengthChange' => false,
            'info' => false,
            'searching' => false,
        ];
    }

    public function mount()
    {
        $findAssetsByCriteriaRequest = $this->requestFactory->make(self::FIND_ASSETS_BY_CRITERIA_REQUEST, [
            "description" => $this->description,
            'unitId' => $this->unitId,
            'type' => $this->type
        ]);
        $this->findAssetsByCriteriaUseCase->execute($findAssetsByCriteriaRequest, function ($response) {
            if ($response->errors)
                $this->data = [];
            else
                $this->data = AssetTableComponent::makeAssetVm($response->assetsDS);
        });
        $this->types = '
            <option value="REF_BANCO">Referencia bancaria</option>
            <option value="TAG_ACCESO">Tag de acceso</option>
            <option value="AUTOMOVIL">Automovil</option>
        ';
    }

    public function render()
    {
        $findAssetsByCriteriaRequest = $this->requestFactory->make(self::FIND_ASSETS_BY_CRITERIA_REQUEST, [
            "description" => $this->description,
            'unitId' => $this->unitId,
            'type' => $this->type
        ]);

        $this->findAssetsByCriteriaUseCase->execute($findAssetsByCriteriaRequest, function ($response) {
            if ($response->errors)
                $this->data = [];
            else
                $this->data = AssetTableComponent::makeAssetVm($response->assetsDS);
        });

        return view('livewire.asset-table-component');
    }

    private static function makeAssetVm($assetsDS)
    {
        $assetsVm = [];
        foreach ($assetsDS as $assetDS) {
            $assetVm = new AssetVm;
            $assetVm->id = $assetDS->id;
            $assetVm->description = $assetDS->description;
            switch ($assetDS->type) {
                case "REF_BANCO":
                    $assetVm->type = 'Referencia Bancaria';
                    break;
                case "AUTOMOVIL":
                    $assetVm->type = 'Automovil';
                    break;
                case "TAG_ACCESO":
                    $assetVm->type = 'Tag de acceso';
                    break;
            }
            $actionEdit = '
            <a href="' . route('asset.edit', $assetDS->id) . '" class="btn btn-xs text-primary mx-1" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $actionDelete = '
            <button class="btn btn-xs text-danger mx-1" title="Delete"' . "wire:click='confirmDeleteAsset($assetVm->id)'" . ' >
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            $actionShow = '
            <a href="' . route('asset.show', $assetDS->id) . '" class="btn btn-xs text-teal mx-1" title="Show">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>';
            $assetVm->buttons = $actionShow . $actionEdit . $actionDelete;
            array_push($assetsVm, $assetVm);
        }

        return $assetsVm;
    }

    public function confirmDeleteAsset($assetId)
    {
        $this->emit('unitSelected', $assetId);
    }

    public function deleteAsset($assetId)
    {
        $deleteAssetRequest = $this->requestFactory->make(self::DELETE_ASSET_REQUEST, ['id' => $assetId]);
        $this->deleteAssetUseCase->execute($deleteAssetRequest, function ($response) {
            $this->emit('actionCompleted');
        });
    }
}
