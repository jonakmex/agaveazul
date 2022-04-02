<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;


class EditAssetRequest extends Request
{
    public $id;
    public $description;
    public $type;

    public function validate(){
        $errors = [];

        if($this->id < 0)
            array_push($errors,["id"=>"MSG_ERR_NOT_NEGATIVE"]);

        if($this->description != null && strlen($this->description) < 1)
            array_push($errors,["description"=>"MSG_ERR_TOO_SHORT"]);

        if(strlen($this->description) > 100)
            array_push($errors,["description"=>"MSG_ERR_TOO_LARGE"]);

        if($this->type != null && $this->type != "AUTOMOVIL" && $this->type != "REF_BANCO" && $this->type != "TAG_ACCESO") 
            array_push($errors, ["type"=>"MSG_ERR_INVALID_TYPE"]);

        return $errors;
    }
}