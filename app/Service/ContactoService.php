<?php
namespace App\Service;
use App\Residente;
use App\AvisoMail;
use App\RegisterToken;
use App\Profile;
use Mail;
use Log;

class ContactoService
{
  public static function crearTokenRegistro(Residente $residente){
    Log::debug('crearTokenRegistro para '.$residente->nombre.'...');
    $token = new RegisterToken();
    $token->token = ContactoService::generarToken();
    $token->profile_id = 2;
    $token->status = 1;
    $token->residente_id = $residente->id;
    Log::debug('Token generated.');
    Log::debug('Retrieving profile '.$residente->id.'...');
    $profile = Profile::where(['descripcion'=>'Residente'])->firstOrFail();
    Log::debug('Profile'.$profile->descripcion);
    $profile->tokens()->save($token);

    $data = array('registerToken'=>$token);
    Log::debug('Sending mail to '.$residente->email.'...');
    Mail::to($residente->email)->queue(AvisoMail::newTokenRegistro($data));
    while( count(Mail::failures()) > 0 ) {
       Mail::to($residente->email)->queue(AvisoMail::newTokenRegistro($data));
    }

    Log::debug('Mail sent');
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
