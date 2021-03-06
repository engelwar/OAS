<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialFaltantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_faltantes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            
            $table->string('codigo')->nullable();
            $table->string('material');
            $table->integer('cantidad')->nullable();
            $table->string('coment')->nullable();
            $table->string('motivo')->nullable();         

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
        Schema::dropIfExists('material_faltantes');
    }
}
