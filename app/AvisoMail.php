<?php

namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AvisoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $data;
    protected $file;
    protected $template;

    public function __construct($data,$file,$template){
      $this->data = $data;
      $this->file = $file;
      $this->template = $template;
    }

    public static function newTokenRegistro($data) {
        $obj = new AvisoMail($data,null,3);
        // other initialization
        return $obj;
    }

    public static function newAvisoReciboGenerado($data) {
        $obj = new AvisoMail($data,null,2);
        // other initialization
        return $obj;
    }

    public static function newAvisoPagoExitoso($data,$file) {
        $obj = new AvisoMail($data,$file,1);
        // other initialization
        return $obj;
    }


    /**
    * Build the message.
    *
    * @return $this
    */
   public function build()
   {
     $subject = 'Default';
     $template = '_emails.test';
     switch($this->template)
     {
       case 1: // Notificacion de pago
        $subject = 'Pago Recibido';
        $template = '_emails.pago';
        $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($subject)
            ->view($template)
            ->with(['data'=>$this->data])
            ->attach($this->file);
       break;
       case 2:
         $subject = 'Solicitud de Pago';
         $template = '_emails.solicitarPago';
         $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
             ->subject($subject)
             ->view($template)
             ->with(['data'=>$this->data]);
         break;
         case 3:
           $subject = 'Token para registro';
           $template = '_emails.tokenRegistro';
           $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
               ->subject($subject)
               ->view($template)
               ->with(['data'=>$this->data]);
           break;
     }


       return $this;
   }
}
