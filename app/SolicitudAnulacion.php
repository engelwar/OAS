<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudAnulacion extends Model
{
  protected $fillable = [
    'fechaemision', 'factura_remision', 'cliente', 'importe', 'motivo', 'user_id', 'estado'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
