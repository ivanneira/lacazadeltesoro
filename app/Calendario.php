<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $protected = [
        'id'
    ];

    protected $fillable = [
       'nombre', 'detalle','active', 'inicio', 'fin', 'created_at', 'updated_at'
    ];
}
