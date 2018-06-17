<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CuentamovimientoCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cuentamovimiento',function(Blueprint $table){
        $table->increments('id')->unsigned();
        $table->integer('cuenta_id')->unsigned();
        $table->foreign('cuenta_id')->references('id')->on('cuentas')->onDelete('cascade');
        $table->string('descripcion');
        $table->string('comprobante');
        $table->dateTime('fecMov');
        $table->decimal('ingreso',10,2)->nullable();
        $table->decimal('egreso',10,2)->nullable();
        $table->decimal('saldo',10,2);
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
      Schema::table('cuentamovimiento',function(Blueprint $table){
           $table->dropForeign('cuentamovimiento_cuenta_id_foreign');
       });
      Schema::dropIfExists('cuentamovimiento');
    }
}
