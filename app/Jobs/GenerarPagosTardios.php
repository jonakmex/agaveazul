<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Config;
use App\Cuota;
use App\Recibos;
use App\Service\ReciboService;
use Carbon\Carbon;


class GenerarPagosTardios implements ShouldQueue
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
      info('Running Pagos Tardios...');
      if($this::shouldRun())
        $this::generarRecibosPagoTardio();
      
      info('Pagos Tardios SUCCESS');
    }

    public function shouldRun(){
      $config = Config::where('key','rec.tardio')->first();
      return $config && $config->value == '1';
    }

    public function generarRecibosPagoTardio(){
      $today = Carbon::today();
      $cuotasVigentes = Cuota::where('estado',1)->whereDate('fecPago','<=',Carbon::today()->toDateString())->get();
      foreach($cuotasVigentes as $cuota){
        $numeroViviendas = $cuota->viviendas()->count();
        $headers = $cuota->recibosHeader()->get();
        foreach($headers as $reciboHeader){
          $fechaLimite = Carbon::parse($reciboHeader->fecVence)->addDays($cuota->periodoGracia);
          $recibosNoPagados = $reciboHeader->recibos()->where('estado','=',1)->get();
          if($numeroViviendas > $recibosNoPagados->count() && $fechaLimite->lt($today))
            foreach($recibosNoPagados as $reciboNoPagado){
              if ($this::shouldGenerateRecibo($cuota,$reciboNoPagado)) 
                ReciboService::generarPagoTardioVivienda($reciboNoPagado);
            }
        }
      }
    }

    public function shouldGenerateRecibo($cuota,$reciboNoPagado){
      return $cuota->periodoGracia > 0 && $reciboNoPagado->referenciaRecibo == null && Recibos::where('referenciaRecibo', '=', $reciboNoPagado->id)->doesntExist();
    }

}