<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Cotizacion_report extends Model
{
    protected $table = 'observacion_cotizacions';// llamada de la tabla observacion
    protected $fillable = ['id','idObs','textObs','user_id','nroMod','fechaC'];

    public function estados()
    {
    
       return $this->hasMany(observatorio_estados::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
