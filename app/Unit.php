<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //protected $table = 'units';
    protected $fillable = ['tag', 'quantity', 'archived'];
}
