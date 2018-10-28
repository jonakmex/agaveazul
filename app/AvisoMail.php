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
       break;

     }
       $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
           ->subject($subject)
           ->view($template)
           ->with(['data'=>$this->data])
           ->attach($this->file);

       return $this;
   }
}
