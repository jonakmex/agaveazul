<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;


class EditContactRequest extends Request
{
    public $name;
    public $lastName;
    public $type;
    public $id;

    public function validate(){
        $errors = [];
        if($this->name != null && strlen($this->name) < 2)
            array_push($errors,["name"=>"MSG_ERR_TOO_SHORT"]);

        if($this->name != null && strlen($this->name) > 20)
            array_push($errors,["name"=>"MSG_ERR_TOO_LARGE"]);

        if($this->lastName != null && strlen($this->lastName) < 2)
            array_push($errors,["lastName"=>"MSG_ERR_TOO_SHORT"]);

        if($this->lastName != null && strlen($this->lastName) > 20)
            array_push($errors,["lastName"=>"MSG_ERR_TOO_LARGE"]);

        if($this->id < 0)
            array_push($errors,["id"=>"MSG_ERR_NOT_NEGATIVE"]);
        
        if($this->name != null && !preg_match('^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$^', $this->name))
            array_push($errors,["name"=>"MSG_ERR_INVALID_CHRACTHER"]);

        if($this->lastName != null && !preg_match('^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$^', $this->lastName))
            array_push($errors,["name"=>"MSG_ERR_INVALID_CHRACTHER"]);

        if($this->type != null && $this->type != "PROPIETARIO" && $this->type != "ARRENDATARIO" && $this->type !="REP_LEGAL")
            array_push($errors,["type"=>"MSG_ERR_INVALID_TYPE"]);

        return $errors;
    }
}