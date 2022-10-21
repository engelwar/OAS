<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class generadorCarta extends Model
{
    protected $table = 'generador_cartas';
    //relacion 1:1 de generador de cartas a perfil de suario
    protected $fillable = [
        'perfil_id'
    ];
    public function perfiles()
    {
        return $this->hasOne(Perfil::class);
    }
}
