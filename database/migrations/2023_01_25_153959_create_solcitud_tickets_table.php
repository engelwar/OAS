<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolcitudTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solcitud_tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('idUser');
            $table->string('user');
            $table->string('sucursal');
            $table->date('fechaInsidente');
            $table->time('horaInsidente');
            $table->text('descripcion');
            $table->string('image');
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
        Schema::dropIfExists('solcitud_tickets');
    }
}
