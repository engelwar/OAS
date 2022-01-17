<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Computadora
 *
 * @property $id
 * @property $tipo
 * @property $ip
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Computadora extends Model
{
    
    static $rules = [
		'tipo' => 'required',
		'ip' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo','ip','estado'];



}
