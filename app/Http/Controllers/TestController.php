<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\AvisoMail;
use App\Recibos;
class TestController extends Controller
{
    public function sendMail(){
      $recibo = new Recibos();
      $recibo->vivienda_id = 1;
      $recibo->descripcion = 'Descripcion';
      $recibo->fecLimite = '2018-01-01';
      $recibo->importe = 300.0;
      $recibo->estado = 1;
      $recibo->saldo = 0;
      $data = array('recibo'=>$recibo);
      Mail::to('jonak@hotmail.com')->queue(new AvisoMail($data));
      return 'SUCCESS';
    }
}
