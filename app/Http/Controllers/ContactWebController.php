<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\ContactVm;
use App\Http\Controllers\ViewModel\ContactIndexVm;
use App\Http\Controllers\ViewModel\ContactCreateVm;
use App\Http\Controllers\ViewModel\ContactShowVm;
use App\Http\Controllers\ViewModel\ContactEditVm;

class ContactWebController extends Controller
{
    private $returnView;
    private $createContactUseCase;
    private $editContactUseCase;
    private $findContactByIdUseCase;
    private $findContactsByCriteriaUseCase;
    private $deleteContactUseCase;
   

    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->createContactUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\CreateContactUseCase');
        $this->editContactUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\EditContactUseCase');
        $this->findContactByIdUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindContactByIdUseCase');
        $this->findContactsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindContactsByCriteriaUseCase');
        $this->deleteContactUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\deleteContactUseCase');
    }

    public function index(Request $request)
    {
        $this->returnView = view('contact.failure');
        $findContactsByCriteriaRequest =  $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindContactsByCriteriaRequest", [
            "name" => $request->name, 
            "lastName" => $request->lastName, 
            "unit_id"=>$request->unit_id, 
            "type"=>$request->type
        ]);
        $this->findContactsByCriteriaUseCase->execute($findContactsByCriteriaRequest, function($response) use ($request){
            if($response->errors) 
                $this->returnView = view('contact.failure')->with("error", $response->errors[0]["name"]);
            else
                $this->returnView = view('contact.index',
                [
                    "contactIndexVm"=>ContactWebController::makeContactIndexVm(
                        $response->contactsDS, $request->unit_id)
                ]); 
        });
        return $this->returnView;
    }

    public function create(Request $request)
    {
        return view('contact.create',
        [
            "contactCreateVm"=>ContactWebController::makeContactCreateVm($request->unit_id)
        ]
       );
    }

    public function store(Request $request)
    {
        $this->returnView = view('contact.failure');
        $createContactRequest = $this->requestFactory->make( 
            "App\Domains\Condo\Boundary\Input\CreateContactRequest",[
            "name"=>$request->name, 
            "lastName"=>$request->lastName, 
            "type"=>$request->type,
            "unit_id"=> $request->unit_id]);
        $this->createContactUseCase->execute($createContactRequest,function($response) {
            if($response->errors) 
            $this->returnView = view('contact.failure'); 
            else
            $this->returnView = redirect()->route('contact.index', ["unit_id"=>$response->contactDS->unit_id]);
        });
        return $this->returnView;
    }

    public function show($id)
    {
        $this->returnView = view('unit.failure');
        $findContactByIdRequest = $this->requestFactory->make( 
            "App\Domains\Condo\Boundary\Input\FindAssetByIdRequest", 
            ["id"=>$id] );
        $this->findContactByIdUseCase->execute($findContactByIdRequest,function($response) {
            if($response->errors) 
                $this->returnView = view('contact.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = view('contact.show',
                ["contactShowVm"=> ContactWebController::makeContactShowVm($response->contactDS)]
               );
        });
        return $this->returnView;
    }


    public function edit($id)
    {
        $this->returnView = view('contact.failure');
        $findContactByIdRequest = $this->requestFactory->make( 
            "App\Domains\Condo\Boundary\Input\FindContactByIdRequest",[
            "id"=>$id]); 
        $this->findContactByIdUseCase->execute($findContactByIdRequest,function($response){
            if($response->errors) 
                $this->returnView = view('contact.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = view('contact.edit',
                ["contactEditVm"=>ContactWebController::makeContactEditVm($response->contactDS)]);
        });

        return $this->returnView;
    }


    public function update(Request $request, $id)
    {
        $editContactRequest = $this->requestFactory->make( "App\Domains\Condo\Boundary\Input\EditContactRequest",[
            "name"=>$request->name, 
            "lastName"=>$request->lastName, 
            "type"=>$request->type, 
            "id"=>$id, 
            "unit_id"=>$request->unit_id]
        );
        $this->editContactUseCase->execute($editContactRequest,function($response){
            if($response->errors) 
                $this->returnView = view('contact.failure'); 
            else 
            $this->returnView = redirect()->route('contact.index',['unit_id'=>$response->contactDS->unit_id]);
        });
        return $this->returnView;
    }


    public function destroy($id)
    {
       $deleteContactRequest = $this->requestFactory->make(
           "App\Domains\Condo\Boundary\Input\DeleteContactRequest",[
               "id"=> $id]);
        
        $this->deleteContactUseCase->execute($deleteContactRequest,function($response){
            if($response->errors) 
                $this->returnView = view('contact.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = redirect()->route('contact.index', ["unit_id"=>$response->contactDS->unit_id])->with('success','contact succesfully removed');
        });
        return $this->returnView;
    }

    public static function makeContactIndexVm($contactsDS, $unit_id){
        $contactIndexVm = new ContactIndexVm;
        $contactIndexVm->unit_id = $unit_id;
        $contactsVm = [];

        foreach($contactsDS as $contactDS){
            $contactVm = new ContactVm;
            $contactVm->id = $contactDS->id;
            $contactVm->name = $contactDS->name;
            $contactVm->lastName = $contactDS->lastName;
            switch($contactDS->type){
                case "PROPIETARIO":
                    $contactVm->type = 'Propietario';
                    break;
                case "ARRENDATARIO":
                    $contactVm->type = 'Arrendatario';
                    break;
                case "REP_LEGAL":
                    $contactVm->type = 'Representante legal';
                    break;
            }
            $contactVm->buttons = '
            <a href="'.route('contact.show', $contactVm->id).'" class="btn btn-xs text-teal mx-1" title="Show">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>
            <a href="'.route('contact.edit', $contactVm->id).'" class="btn btn-xs text-primary mx-1" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>
            <form action="'.route('contact.destroy', $contactVm->id).'" method="POST" class="d-inline">
               '.csrf_field().method_field('DELETE').'
                <button type="submit" class="btn btn-xs text-danger mx-1" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>
            </form>';
            
            array_push($contactsVm, $contactVm);
        }

        $contactIndexVm->contactsVm = $contactsVm;
        return  $contactIndexVm;
    }

    public static function makeContactCreateVm($unit_id){
        $ContactCreateVm = new ContactCreateVm;
        $ContactCreateVm->unit_id = $unit_id;
        $ContactCreateVm->types = [
            ['key'=>"PROPIETARIO", 'label'=>'Propietario'],
            ['key'=>"ARRENDATARIO", 'label'=>'Arrendatario'],
            ['key'=>'REP_LEGAL', 'label'=>'Representante Legal']
        ];

        return $ContactCreateVm;
    }

    public static function makeContactShowVm($contactDS){
        $contactShowVm = new ContactShowVm;
        $contactShowVm->id = $contactDS->id;
        $contactShowVm->unit_id = $contactDS->unit_id;
        $contactShowVm->name = $contactDS->name;
        $contactShowVm->lastName = $contactDS->lastName;
        switch($contactDS->type){
            case "PROPIETARIO":
                $contactShowVm->type = 'Propietario';
                break;
            case "ARRENDATARIO":
                $contactShowVm->type = 'Arrendatario';
                break;
            case "REP_LEGAL":
                $contactShowVm->type = 'Representante legal';
                break;
        } 

        return $contactShowVm;
    }

    public static function makeContactEditVm($contactDS){
        $contactEditVm = new ContactEditVm;
        $contactEditVm->id = $contactDS->id;
        $contactEditVm->unit_id = $contactDS->unit_id;
        $contactEditVm->name = $contactDS->name;
        $contactEditVm->lastName = $contactDS->lastName;
        $contactEditVm->type['key'] = $contactDS->type;
        switch($contactDS->type){
            case "PROPIETARIO":
                $contactEditVm->type['value'] = 'Propietario';
                break;
            case "ARRENDATARIO":
                $contactEditVm->type['value'] = 'Arrendatario';
                break;
            case "REP_LEGAL":
                $contactEditVm->type['value']= 'Representante legal';
                break;
            default:  $contactEditVm->type['value'] = 'Desconocido';
        }

        $contactEditVm->types = [
            ['key'=>"PROPIETARIO", 'label'=>'Propietario'],
            ['key'=>"ARRENDATARIO", 'label'=>'Arrendatario'],
            ['key'=>"REP_LEGAL", 'label'=>'Representante legal']
        ];
        return  $contactEditVm;
    }

}