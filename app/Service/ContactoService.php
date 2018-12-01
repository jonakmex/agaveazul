<?php
namespace App\Service;
use App\Residente;
use App\AvisoMail;
use App\RegisterToken;
use App\Profile;
use Mail;

class ContactoService
{
  public static function crearTokenRegistro(Residente $residente){
    $token = new RegisterToken();
    $token->token = ContactoService::generarToken();
    $token->profile_id = 2;
    $token->status = 1;
    $token->residente_id = $residente->id;

    $profile = Profile::where(['descripcion'=>'Residente'])->firstOrFail();

    $profile->tokens()->save($token);

    $data = array('registerToken'=>$token);
    Mail::to($residente->email)->queue(AvisoMail::newTokenRegistro($data));
  }

  private static function generarToken($length = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}
