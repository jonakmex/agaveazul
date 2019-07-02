<?php
namespace App\Service;
use App\Service\ConfigService;
use App\Residente;
use App\AvisoMail;
use App\RegisterToken;
use App\Profile;
use Mail;
use Log;

class ContactoService
{
  public static function crearTokenRegistro(Residente $residente){
    $token = new RegisterToken();
    $token->token = ContactoService::generarToken();
    $profile = Profile::where('descripcion','Residente')->first();
    $token->profile_id = $profile->id;
    $token->status = 1;
    //$residente->token()->save($token);
    $token->save();
    $residente->register_token_id = $token->id;
    $residente->save();
    $data = array('registerToken'=>$token);
    //if(ConfigService::mailEnabled()){
      Mail::to($residente->email)->queue(AvisoMail::newTokenRegistro($data));
      while( count(Mail::failures()) > 0 ) {
        Mail::to($residente->email)->queue(AvisoMail::newTokenRegistro($data));
      }
      
    //}
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
