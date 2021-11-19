<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $protected = [
        'id'
    ];

    protected $fillable = [
       'alumno_id', 'monto','desde', 'hasta', 'created_at', 'updated_at'
    ];

    public function Alumnos()
    {
        return $this->belongsTo(Alumnos::class,'alumno_id');
    }
}
