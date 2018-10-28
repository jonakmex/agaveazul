<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CuotasCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cuotas',function(Blueprint $table){
          $table->increments('id')->unsigned;
          $table->string('descripcion',50);
          $table->string('clave',5);
          $table->decimal('importe',10,2);
          $table->date('fecPago');
          $table->integer('periodoGracia')->unsigned;
          $table->integer('periodicidad')->nullable()->unsigned;
          $table->integer('nPeriodos')->nullable()->unsigned;
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
        Schema::dropIfExists('cuotas');
    }
}
