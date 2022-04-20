<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;

class CreateContactRequest extends Request
{
    public $name;
    public $lastName;
    public $type;
    public $unit_id;

    public function validate(){
        $errors = [];
        if(strlen($this->name) < 2)
            array_push($errors,["name"=>"MSG_ERR_TOO_SHORT"]);

        if(strlen($this->name) > 20)
            array_push($errors,["name"=>"MSG_ERR_TOO_LARGE"]);

        if(strlen($this->lastName) < 2)
            array_push($errors,["lastName"=>"MSG_ERR_TOO_SHORT"]);

        if(strlen($this->lastName) > 20)
            array_push($errors,["lastName"=>"MSG_ERR_TOO_LARGE"]);
        
        if(!preg_match('^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$^', $this->name))
            array_push($errors,["name"=>"MSG_ERR_INVALID_CHRACTHER"]);
        
        if(!preg_match('^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$^', $this->lastName))
            array_push($errors,["lastName"=>"MSG_ERR_INVALID_CHRACTHER"]);
        
        if( $this->type != "PROPIETARIO" && $this->type != "ARRENDATARIO" && $this->type !="REP_LEGAL")
            array_push($errors,["type"=>"MSG_ERR_INVALID_TYPE"]);

        if($this->unit_id < 0)
            array_push($errors, ["unit_id"=>"MSG_ERR_MUST_BE_POSITIVE"]);

        return $errors;
    }
}