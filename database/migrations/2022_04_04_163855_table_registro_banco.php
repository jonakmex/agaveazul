<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRegistroBanco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrobanco',function(Blueprint $table){
            $table->increments('id')->unsigned;
            $table->string('clave',2000);
            $table->string('tipo');
            $table->string('moneda');
            $table->string('uso_futuro');
            $table->string('cuenta');
            $table->date('fecha');
            $table->string('referencia');
            $table->decimal('importe', $precision = 8, $scale = 2);
            $table->string('tipo_transaccion');
            $table->decimal('saldo', $precision = 8, $scale = 2);
            $table->string('transaccion');
            $table->string('leyenda_1');
            $table->string('leyenda_2');
            $table->string('informacion_adicional_spei',1000);
            $table->integer('estado')->unsigned;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrobanco');
    }
}
