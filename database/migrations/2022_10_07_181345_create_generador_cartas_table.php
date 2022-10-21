<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneradorCartasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generador_cartas', function (Blueprint $table) {
            $table->id();
            $table->integer('userAuth');
            $table->string('estado1');
            $table->string('estado2');
            $table->string('estado3');
            $table->text('Descripcion');
            $table->text('DescripcionO');
            $table->foreignId('perfil_id')->references('id')->on('perfils')->unique()->nullable();
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
        Schema::dropIfExists('generador_cartas');
    }
}
