<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;


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
                $this->returnView = view('contact.index', ["contacts"=> $response->contactsDS, "unit_id"=>$request->unit_id]); 
        });
        return $this->returnView;
    }

    public function create(Request $request)
    {
        return view('contact.create', ["unit_id"=>$request->unit_id]);
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
                $this->returnView = view('contact.show',['contact' => $response->contactDS]);
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
                $this->returnView = view('contact.edit',['contact' => $response->contactDS]);
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
                $this->returnView = view('contact.show',['contact' => $response->contactDS]);
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
}