<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Cuota;
use App\Reciboheader;
use App\Recibos;
use Carbon\Carbon;
use Mail;
use App\AvisoMail;
use App\Vivienda;
use App\Service\ReciboService;

class GenerarRecibos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      info('Running generator...');
      ReciboService::generarRecibos();
      info('Generator SUCCESS');
    }

    public function getHeaders($cuota){
      $headers = $cuota->recibosHeader;
      $toCreate = array();
      $today = date('Y-m-d H:i:s');
      $loopDate = $cuota->fecPago;
      //info('------------------Date>'.date("M", strtotime($loopDate)));
      while($loopDate < $today && ( (count($toCreate)+count($headers))<$cuota->nPeriodos || $cuota->nPeriodos == 0) ){
        $exists = false;
        foreach($headers as $header){
          if(date_diff(date_create($loopDate),date_create($header->fecVence))->format('%a')==0){
            $exists = true;
            break;
          }
        }

        if(!$exists){
          switch($cuota->periodicidad){
              case 1:
                $descripcion = ''.strtoupper(date("M", strtotime($loopDate))).' '.strtoupper(date("Y", strtotime($loopDate)));
              break;
              case 2:
                $descripcion = ''.strtoupper(date("Y", strtotime($loopDate)));
              break;
              default:
                $descripcion = $cuota->descripcion;
          }
          array_push($toCreate,['descripcion'=>$descripcion,'fecVence'=>$loopDate,'fecLimite'=>date_add(date_create($loopDate), date_interval_create_from_date_string($cuota->periodoGracia.' days'))]);
        }

        switch($cuota->periodicidad){
            case 1:
              $loopDate = date('Y-m-d', strtotime("+1 months", strtotime($loopDate)));
            break;
            case 2:
              $loopDate = date('Y-m-d', strtotime("+1 years", strtotime($loopDate)));
            break;
            default:
              $loopDate = date('Y-m-d', strtotime("+1 days", strtotime($loopDate)));
        }
      }
      return $toCreate;
    }

}
