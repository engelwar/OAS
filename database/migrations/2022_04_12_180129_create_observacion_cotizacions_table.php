<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacionCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacion_cotizacions', function (Blueprint $table) {
           //$table->id();
           $table->id();
            $table->integer('idObs')->nullable();//el id es el numero NR
            $table->string('textObs'); 
            $table->integer('user_id');
            $table->string('modifUno');
            $table->string('modifiDos');    
            $table->integer('nroMod');
            $table->dateTime('fechaC')->nullable();
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
        Schema::dropIfExists('observacion_cotizacions');
    }
}
