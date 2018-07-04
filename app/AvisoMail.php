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

    public function __construct($data){
      $this->data = $data;
    }

    /**
    * Build the message.
    *
    * @return $this
    */
   public function build()
   {
       $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
           ->subject('Solicitud de pago')
           ->view('_emails.test')
           ->with(['data'=>$this->data]);

       return $this;
   }
}
