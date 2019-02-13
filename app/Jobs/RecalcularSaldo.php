<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Cuenta;
use App\Service\CuentaService;
class RecalcularSaldo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $cuenta_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cuenta_id)
    {
        $this->cuenta_id = $cuenta_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $cuenta = Cuenta::findOrFail($this->cuenta_id);
        info('Recalcular Saldo...'.$cuenta->descripcion );
      CuentaService::recalcularSaldo($cuenta);
      info('Recalcular Saldo - SUCCESS');
    }
}
