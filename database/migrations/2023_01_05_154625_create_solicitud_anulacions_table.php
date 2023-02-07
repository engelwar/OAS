<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudAnulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_anulacions', function (Blueprint $table) {
            $table->id();
            $table->date('fechaemision');
            $table->integer('factura_remision');
            $table->string('cliente');
            $table->double('importe');
            $table->string('motivo');
            $table->integer('user_id');
            $table->integer('estado')->NULL;
            
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
        Schema::dropIfExists('solicitud_anulacions');
    }
}
