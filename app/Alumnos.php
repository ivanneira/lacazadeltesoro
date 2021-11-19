<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    protected $protected = [
        'id'
    ];

    protected $fillable = [
       'nombre', 'apellido','contacto','documento','email','foto','active', 'created_at', 'updated_at'
    ];
}
