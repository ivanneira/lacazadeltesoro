<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recordatorios extends Model
{
    protected $protected = [
        'id'
    ];

    protected $fillable = [
       'nombre', 'detalle','active', 'created_at', 'updated_at'
    ];
}
