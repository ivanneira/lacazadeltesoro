<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $protected = [
        'id'
    ];

    protected $fillable = [
       'alumno_id','inicio','fin', 'created_at', 'updated_at'
    ];

    public function Alumnos()
    {
        return $this->belongsTo(Alumnos::class,'alumno_id');
    }

    public function Pagos()
    {
        return $this->belongsTo(Pagos::class,'alumno_id');
    }
}
