<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\AssetCreateVm;
// use App\Http\Controllers\ViewModel\AssetIndexVm;
use App\Http\Controllers\ViewModel\AssetEditVm;
use App\Http\Controllers\ViewModel\AssetShowVm;
// use App\Http\Controllers\ViewModel\AssetVm;

class AssetWebController extends Controller
{
    private $returnView;
    private $requestFactory;
    // private $createAssetUseCase;
    // private $editAssetUseCase;
    private $findAssetByIdUseCase;
    // private $findAssetsByCriteriaUseCase;
    // private $deleteAssetUseCase;

    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        // $this->createAssetUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\CreateAssetUseCase');
        // $this->editAssetUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\EditAssetUseCase');
        $this->findAssetByIdUseCase = $useCaseFactory->make(FIND_ASSET_BY_ID_USE_CASE);
        // $this->findAssetsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindAssetsByCriteriaUseCase');
        // $this->deleteAssetUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\DeleteAssetUseCase');
    }

    public function index(Request $request)
    {
        // $findAssetsByCriteriaRequest = $this->requestFactory->make(
        //     "App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest", [
        //         "description"=>$request->description,
        //         "type"=>$request->type,
        //         "unitId"=>$request->unitId
        // ]);
        // $this->findAssetsByCriteriaUseCase->execute($findAssetsByCriteriaRequest, function($response) use($request){
        //     if(property_exists($response, 'assetsDS')){
                // $this->returnView = view('asset.index', [
                //     "assetIndexVm"=>AssetWebController::makeAssetIndexVm($response->assetsDS, $request->unitId)
                // ]);
        //     }
        //     else 
        //         $this->returnView = view('asset.failure', ["errors"=>$response->errors[0]]);
        // });

        // return $this->returnView;
        return view('asset.index', ['unitId'=> $request->unitId]);
    }

    public function create(Request $request)
    {
        return view('asset.create',[
            "assetCreateVm"=>AssetWebController::makeAssetCreateVm($request->unitId)
        ]);
    }

    public function store(Request $request)
    {
        // $this->returnView = view('asset.failure');
        // $createAssetRequest = $this->requestFactory->make(
        //     "App\Domains\Condo\Boundary\Input\CreateAssetRequest",[
        //     "description"=>$request->description, 
        //     "unitId"=>$request->unitId,
        //     "type"=>$request->type
        // ]);
        // $this->createAssetUseCase->execute($createAssetRequest,function($response){
        //     if(property_exists($response, 'assetDS'))
        //         $this->returnView = redirect()->route('asset.index',['unitId'=> $response->assetDS->unitId]);
        //     else 
        //         $this->returnView = view('asset.failure',['errors'=>$response->errors]);
        // });

        // return $this->returnView;
    }

    public function show($id){
        $this->returnView = view('asset.failure');
        $findAssetByIdRequest = $this->requestFactory->make(FIND_ASSET_BY_ID_REQUEST, ["id"=>$id]);
        $this->findAssetByIdUseCase->execute($findAssetByIdRequest, function($response){
            $this->returnView = view('asset.show', ["assetShowVm"=> AssetWebController::makeAssetShowVm($response->assetDS)]);
        });
        return $this->returnView;
    }

    public function edit($id){
        $this->returnView = view('asset.failure');
        $findAssetByIdRequest = $this->requestFactory->make(FIND_ASSET_BY_ID_REQUEST, ["id"=>$id]);
        $this->findAssetByIdUseCase->execute($findAssetByIdRequest, function($response){
            $this->returnView = view('asset.edit', ["assetEditVm"=>AssetWebController::makeAssetEditVm($response->assetDS)]);
        });
        return $this->returnView;
    }

    public function update(Request $request, $id){
        // $this->returnView = view('asset.failure');
        // $editAssetRequest = $this->requestFactory->make(
        //     "App\Domains\Condo\Boundary\Input\EditAssetRequest", ["id"=>$id, "description"=> $request->description, "type"=>$request->type]
        // );
        // $this->editAssetUseCase->execute($editAssetRequest, function($response){
        //     $this->returnView = redirect()->route('asset.index',['unitId'=>$response->assetDS->unitId]);
        // });
        // return $this->returnView;
    }

    public function destroy($id){
        // $this->returnView = view('asset.failure');
        // $deleteAssetRequest = $this->requestFactory->make(
        //     "App\Domains\Condo\Boundary\Input\DeleteAssetRequest",["id"=>$id]);
        // $this->deleteAssetUseCase->execute($deleteAssetRequest, function($response){
        //     $this->returnView = redirect()->route('asset.index',['unitId'=>$response->assetDS->unitId]);
        // });
        // return $this->returnView;
    }

    // public static function makeAssetIndexVm($assetsDS, $unitId){
    //     $assetIndexVm = new AssetIndexVm;
    //     $assetIndexVm->unitId = $unitId;
    //     $assetsVm = [];

    //     foreach($assetsDS as $assetDS){
    //         $assetVm = new AssetVm;
    //         $assetVm->id = $assetDS->id;
    //         $assetVm->description = $assetDS->description;
    //         switch($assetDS->type){
    //             case "REF_BANCO":
    //                 $assetVm->type = 'Referencia Bancaria';
    //                 break;
    //             case "AUTOMOVIL":
    //                 $assetVm->type = 'Automovil';
    //                 break;
    //             case "TAG_ACCESO":
    //                 $assetVm->type = 'Tag de acceso';
    //                 break;
    //         }
        
    //         $assetVm->buttons = '
    //         <a href="'.route('asset.show', $assetVm->id).'" class="btn btn-xs text-teal mx-1" title="Show">
    //             <i class="fa fa-lg fa-fw fa-eye"></i>
    //         </a>
    //         <a href="'.route('asset.edit', $assetVm->id).'" class="btn btn-xs text-primary mx-1" title="Edit">
    //             <i class="fa fa-lg fa-fw fa-pen"></i>
    //         </a>
    //         <form action="'.route('asset.destroy', $assetVm->id).'" method="POST" class="d-inline">
    //            '.csrf_field().method_field('DELETE').'
    //             <button type="submit" class="btn btn-xs text-danger mx-1" title="Delete">
    //                 <i class="fa fa-lg fa-fw fa-trash"></i>
    //             </button>
    //         </form>';
    //         array_push($assetsVm, $assetVm);
    //     }

    //     $assetIndexVm->assetsVm = $assetsVm;
    //     return $assetIndexVm;
    // }

    public static function makeAssetShowVm($assetDS){
        $assetShowVm = new AssetShowVm;
        $assetShowVm->id = $assetDS->id;
        $assetShowVm->unitId = $assetDS->unitId;
        $assetShowVm->description = $assetDS->description;
        switch($assetDS->type){
            case "REF_BANCO":
                $assetShowVm->type = 'Referencia Bancaria';
                break;
            case "AUTOMOVIL":
                $assetShowVm->type = 'Automovil';
                break;
            case "TAG_ACCESO":
                $assetShowVm->type = 'Tag de acceso';
                break;
        } 

        return $assetShowVm;
    }

    public static function makeAssetCreateVm($unitId){
        $assetCreateVm = new AssetCreateVm;
        $assetCreateVm->unitId = $unitId;
        $assetCreateVm->types = '
            <option value="REF_BANCO">Referencia bancaria</option>
            <option value="TAG_ACCESO">Tag de acceso</option>
            <option value="AUTOMOVIL">Automovil</option>
        ';
        return $assetCreateVm;
    }

    public static function makeAssetEditVm($assetDS){
        $assetEditVm = new AssetEditVm;
        $assetEditVm->id = $assetDS->id;
        $assetEditVm->unitId = $assetDS->unitId;
        $assetEditVm->description = $assetDS->description;
        $assetEditVm->type = $assetDS->type;

        $assetEditVm->types = '
            <option value="REF_BANCO">Referencia bancaria</option>
            <option value="TAG_ACCESO">Tag de acceso</option>
            <option value="AUTOMOVIL">Automovil</option>
        ';
        return $assetEditVm;
    }
}
