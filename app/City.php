<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //protected $table = 'cities';
    protected $fillable = ['state_id', 'city', 'capital', 'archived'];

    public function state()
    {
    	return $this->belongsTo('App\State');
    }
}
