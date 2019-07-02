<?php
namespace App\Service;
use App\Service\ConfigService;
use App\BusinessException;
use App\Staff;
use App\AvisoMail;
use App\RegisterToken;
use App\Profile;
use Mail;

class StaffService{
    public static function save(Staff $staff)
    {
      if($staff->save()){
        return $staff;
      }
      else{
        throw new BusinessException();
      }
    }

    public static function crearTokenRegistro(Staff $staff){
      $token = new RegisterToken();
      $token->token = StaffService::generarToken();
      $profile = Profile::where('descripcion','Operador')->first();
      $token->profile_id = $profile->id;
      $token->status = 1;
      //$residente->token()->save($token);
      $token->save();
      $staff->register_token_id = $token->id;
      $staff->save();
      $data = array('registerToken'=>$token);
      //if(ConfigService::mailEnabled()){
        Mail::to($staff->email)->queue(AvisoMail::newTokenRegistro($data));
        while( count(Mail::failures()) > 0 ) {
          Mail::to($staff->email)->queue(AvisoMail::newTokenRegistro($data));
        }
        info('Mail sent');
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