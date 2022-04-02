<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;

class CreateAssetRequest extends Request
{
    public $unitId;
    public $description;
    public $type;

    public function validate(){
        $errors = [];

        if($this->unitId < 0)
            array_push($errors, ["unitId"=>"MSG_ERR_MUST_BE_POSITIVE"]);
            
        if(strlen($this->description) < 1)
            array_push($errors,["description"=>"MSG_ERR_TOO_SHORT"]);

        if(strlen($this->description) > 100)
            array_push($errors,["description"=>"MSG_ERR_TOO_LARGE"]); 
        
        if($this->type != "AUTOMOVIL" && $this->type != "REF_BANCO" && $this->type != "TAG_ACCESO") 
            array_push($errors, ["type"=>"MSG_ERR_INVALID_TYPE"]);
            
        return $errors;
    }
}