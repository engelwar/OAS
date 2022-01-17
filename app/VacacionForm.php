<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacacionForm extends Model
{
    protected $fillable = [
        'fecha_ini', 'fecha_fin', 'fecha_ret', 'dias_v', 'dias_v_l', 
        'dias', 'dias_l', 'saldo_dias', 'saldo_dias_l', 'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function firmas()
    {
        return $this->belongsToMany(Firma::class)->withTimestamps();
    }
}
