<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clearing extends Model
{
    protected $protected = [
        'id'
    ];
    protected $fillable = [
       'name', 'comment', 'date','discount','active', 'created_at', 'updated_at'
    ];
}
