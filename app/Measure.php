<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $table = 'measure';
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function ageEstatus(){
      $result = ['color'=>'bg-aqua','desc'=>'-'];
      $user = $this->user;
      $age = $this->age;
      if($age <= $user->getAge()){
          $result = ['color'=>'bg-green','desc'=>'Bien'];
      }
      else{
          $result = ['color'=>'bg-red','desc'=>'Mayor'];  
      }
      return $result;
    }
    
    public function visceralEstatus(){
     $result = ['color'=>'bg-aqua','desc'=>'-'];
     $visceral = $this->visceral;
     if($visceral <10){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'0','max'=>'9'];}
     else if($visceral >= 10 && $visceral < 15){$result = ['color'=>'bg-yellow','desc'=>'Alto','min'=>'0','max'=>'9'];}
     else if($visceral >= 15 ){$result = ['color'=>'bg-red','desc'=>'Muy Alto','min'=>'0','max'=>'9'];}
     return $result;
    }
    
    public function muscleEstatus(){
     $result = ['color'=>'bg-aqua','desc'=>'-'];
     $user = $this->user;
      $muscle = $this->muscle;
      if($user->gender == 'F'){
          if($user->getAge() >= 20 && $user->getAge()<40){
             if($muscle < 24.3){$result = ['color'=>'bg-red','desc'=>'Bajo','min'=>'24.3','max'=>'35.4'];}
             else if($muscle >= 24.3 && $muscle < 30.4){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'24.3','max'=>'35.4'];}
             else if($muscle >= 30.4 && $muscle < 35.4){$result = ['color'=>'bg-green','desc'=>'Elevado','min'=>'24.3','max'=>'35.4'];}
             else if($muscle >= 35.4){$result = ['color'=>'bg-green','desc'=>'Muy Elevado','min'=>'24.3','max'=>'35.4'];}
          }
          else if($user->getAge() >= 40 && $user->getAge()<60){
             if($muscle < 24.1){$result = ['color'=>'bg-red','desc'=>'Bajo','min'=>'24.1','max'=>'35.2'];}
             else if($muscle >= 24.1 && $muscle < 30.2){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'24.1','max'=>'35.2'];}
             else if($muscle >= 30.2 && $muscle < 35.2){$result = ['color'=>'bg-green','desc'=>'Elevado','min'=>'24.1','max'=>'35.2'];}
             else if($muscle >= 35.2){$result = ['color'=>'bg-green','desc'=>'Muy Elevado','min'=>'24.1','max'=>'35.2'];}
          }
          else if($user->getAge() >= 60 && $user->getAge()<80){
             if($muscle < 23.9){$result = ['color'=>'bg-red','desc'=>'Bajo','min'=>'23.9','max'=>'35.0'];}
             else if($muscle >= 23.9 && $muscle < 30.0){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'23.9','max'=>'35.0'];}
             else if($muscle >= 30.0 && $muscle < 35.0){$result = ['color'=>'bg-green','desc'=>'Elevado','min'=>'23.9','max'=>'35.0'];}
             else if($muscle >= 35.0){$result = ['color'=>'bg-green','desc'=>'Muy Elevado','min'=>'23.9','max'=>'35.0'];}   
          }
      }
      else{
          if($user->getAge() >= 20 && $user->getAge()<40){
             if($muscle < 33.3){$result = ['color'=>'bg-red','desc'=>'Bajo','min'=>'33.3','max'=>'44.1'];}
             else if($muscle >= 33.3 && $muscle < 39.4){$result = ['color'=>'bg-yellow','desc'=>'Normal','min'=>'33.3','max'=>'44.1'];}
             else if($muscle >= 39.4 && $muscle < 44.1){$result = ['color'=>'bg-green','desc'=>'Elevado','min'=>'33.3','max'=>'44.1'];}
             else if($muscle >= 44.1){$result = ['color'=>'bg-green','desc'=>'Muy Elevado','min'=>'33.3','max'=>'44.1'];}  
          }
          else if($user->getAge() >= 40 && $user->getAge()<60){
             if($muscle < 33.1){$result = ['color'=>'bg-red','desc'=>'Bajo','min'=>'33.1','max'=>'43.9'];}
             else if($muscle >= 33.1 && $muscle < 39.2){$result = ['color'=>'bg-yellow','desc'=>'Normal','min'=>'33.1','max'=>'43.9'];}
             else if($muscle >= 39.2 && $muscle < 43.9){$result = ['color'=>'bg-green','desc'=>'Elevado','min'=>'33.1','max'=>'43.9'];}
             else if($muscle >= 43.9){$result = ['color'=>'bg-green','desc'=>'Muy Elevado','min'=>'33.1','max'=>'43.9'];} 
          }
          else if($user->getAge() >= 60 && $user->getAge()<80){
             if($muscle < 32.9){$result = ['color'=>'bg-red','desc'=>'Bajo','min'=>'32.9','max'=>'43.7'];}
             else if($muscle >= 32.9 && $muscle < 39.0){$result = ['color'=>'bg-yellow','desc'=>'Normal','min'=>'32.9','max'=>'43.7'];}
             else if($muscle >= 39.0 && $muscle < 43.7){$result = ['color'=>'bg-green','desc'=>'Elevado','min'=>'32.9','max'=>'43.7'];}
             else if($muscle >= 43.7){$result = ['color'=>'bg-green','desc'=>'Muy Elevado','min'=>'32.9','max'=>'43.7'];} 
          }
      }
      return $result;
    }
    
    public function bmiEstatus(){
      $result = ['color'=>'bg-aqua','desc'=>'-'];
      if($this->bmi < 18.5 ) { $result = ['color'=>'bg-yellow','desc'=>'Peso inferior al normal','min'=>'18.5','max'=>'25'];}
      else if ($this->bmi >= 18.5 && $this->bmi < 25 ){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'18.5','max'=>'25']; }
      else if ($this->bmi >= 25 && $this->bmi < 30  ){ $result = ['color'=>'bg-yellow','desc'=>'Sobrepeso','min'=>'18.5','max'=>'25']; }
      else {$result = ['color'=>'bg-yellow','desc'=>'Obesidad','min'=>'18.5','max'=>'25']; }   
        
      return $result;
    }
    
    public function fatEstatus(){
      $result = ['color'=>'bg-aqua','desc'=>'-'];
      $user = $this->user;
      $fat = $this->fat;
      if($user->gender == 'F'){
          if($user->getAge() >= 20 && $user->getAge()<40){
             if($fat < 21.0){$result = ['color'=>'bg-green','desc'=>'Bajo','min'=>'21.0','max'=>'32.9'];}
             else if($fat >= 21.0 && $fat < 33.0){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'21.0','max'=>'32.9'];}
             else if($fat >= 33.0 && $fat < 39.0){$result = ['color'=>'bg-yellow','desc'=>'Elevado','min'=>'21.0','max'=>'32.9'];}
             else if($fat >= 39.0){$result = ['color'=>'bg-red','desc'=>'Muy Elevado','min'=>'21.0','max'=>'32.9'];}
          }
          else if($user->getAge() >= 40 && $user->getAge()<60){
             if($fat < 23.0){$result = ['color'=>'bg-green','desc'=>'Bajo','min'=>'23.0','max'=>'33.9'];}
             else if($fat >= 23.0 && $fat < 34.0){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'23.0','max'=>'33.9'];}
             else if($fat >= 34.0 && $fat < 40.0){$result = ['color'=>'bg-yellow','desc'=>'Elevado','min'=>'23.0','max'=>'33.9'];}
             else if($fat >= 40.0){$result = ['color'=>'bg-red','desc'=>'Muy Elevado','min'=>'23.0','max'=>'33.9'];}
          }
          else if($user->getAge() >= 60 && $user->getAge()<80){
             if($fat < 24.0){$result = ['color'=>'bg-green','desc'=>'Bajo','min'=>'24.0','max'=>'35.9'];}
             else if($fat >= 24.0 && $fat < 36.0){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'24.0','max'=>'35.9'];}
             else if($fat >= 36.0 && $fat < 42.0){$result = ['color'=>'bg-yellow','desc'=>'Elevado','min'=>'24.0','max'=>'35.9'];}
             else if($fat >= 42.0){$result = ['color'=>'bg-red','desc'=>'Muy Elevado','min'=>'24.0','max'=>'35.9'];}   
          }
      }
      else{
          if($user->getAge() >= 20 && $user->getAge()<40){
             if($fat < 8.0){$result = ['color'=>'bg-green','desc'=>'Bajo','min'=>'8.0','max'=>'19.9'];}
             else if($fat >= 8.0 && $fat < 20.0){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'8.0','max'=>'19.9'];}
             else if($fat >= 20.0 && $fat < 25.0){$result = ['color'=>'bg-yellow','desc'=>'Elevado','min'=>'8.0','max'=>'19.9'];}
             else if($fat >= 25.0){$result = ['color'=>'bg-red','desc'=>'Muy Elevado','min'=>'8.0','max'=>'19.9'];}  
          }
          else if($user->getAge() >= 40 && $user->getAge()<60){
             if($fat < 11.0){$result = ['color'=>'bg-green','desc'=>'Bajo','min'=>'11.0','max'=>'21.9'];}
             else if($fat >= 11.0 && $fat < 22.0){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'11.0','max'=>'21.9'];}
             else if($fat >= 22.0 && $fat < 28.0){$result = ['color'=>'bg-yellow','desc'=>'Elevado','min'=>'11.0','max'=>'21.9'];}
             else if($fat >= 28.0){$result = ['color'=>'bg-red','desc'=>'Muy Elevado','min'=>'11.0','max'=>'21.9'];} 
          }
          else if($user->getAge() >= 60 && $user->getAge()<80){
             if($fat < 13.0){$result = ['color'=>'bg-green','desc'=>'Bajo','min'=>'13.0','max'=>'24.9'];}
             else if($fat >= 13.0 && $fat < 25.0){$result = ['color'=>'bg-green','desc'=>'Normal','min'=>'13.0','max'=>'24.9'];}
             else if($fat >= 25.0 && $fat < 30.0){$result = ['color'=>'bg-yellow','desc'=>'Elevado','min'=>'13.0','max'=>'24.9'];}
             else if($fat >= 30.0){$result = ['color'=>'bg-red','desc'=>'Muy Elevado','min'=>'13.0','max'=>'24.9'];} 
          }
      }
      return $result;
    }
}
