<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockventa extends Model
{
    protected $fillable = [
        'catprod','codprod','desprod','umprod','canprod','idalmacen','cod_user'
    ];
}
