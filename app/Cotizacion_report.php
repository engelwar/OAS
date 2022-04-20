<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Cotizacion_report extends Model
{
    protected $table = 'observacion_cotizacions';// llamada de la tabla observacion
    protected $fillable = ['id','idObs','textObs','user_id','modifUno','modifiDos','nroMod','fechaC'];
}
