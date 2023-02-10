<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacacionForm extends Model
{
  protected $fillable = [
    'detalle_vacacion', 'fecha_ini', 'fecha_fin', 'fecha_ret', 'fecha_fin_aut', 'fecha_ret_aut', 'fecha_ini_aut', 'dias_v', 'dias_v_l','dias', 'dias_l', 'saldo_dias', 'saldo_dias_l', 'estado', 'detalle_estado', 'user_id', 'jefe_id', 'admin_id'
  ];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function jefe()
  {
    return $this->belongsTo(User::class);
  }
  public function admin()
  {
    return $this->belongsTo(User::class);
  }
  public function area()
  {
    return $this->belongsTo(Area::class, 'area_id');
  }
  public function firmas()
  {
    return $this->belongsToMany(Firma::class)->withTimestamps();
  }

  public function scopeEstado($query, $estado)
  {
    if ($estado == 'Aceptada' || $estado == 'Rechazada') {
      return $query->where('estado', 'LIKE', "%$estado%");
    } elseif ($estado == 'null') {
      return $query->where('estado', '=', null);
    }
  }

  public function scopeUser($query, $buscar, $dato)
  {
    if ($buscar == 1 && $dato != '') {
      $resultado = VacacionForm::join('perfils','perfils.user_id','=','vacacion_forms.user_id')
      ->select('vacacion_forms.*')
      ->where('perfils.nombre', 'LIKE', "%$dato%");
      return $resultado;
    } elseif ($buscar == 2 && $dato != '') {
      $resultado = VacacionForm::join('perfils','perfils.user_id','=','vacacion_forms.user_id')
      ->select('vacacion_forms.*')
      ->where('perfils.ci', '=', "$dato");
      return $resultado;
    }
  }
}
