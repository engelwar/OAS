<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacionCotizacion extends Model
{
    protected $fillable = [
        'id','idObs','user_id','nroMod','fechC','creared_at' 
    ];

    public function estados()
    {
        return $this->hasmany(observacion_estados::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
