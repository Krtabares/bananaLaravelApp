<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
    	'address_1',
    	'address_2',
    	'address_3',
    	'address_4',
    	'zip',
    	'postal_add',
    	'city_id',
    	'state_id',
    	'country_id',
    	'organization_id',
    	'client_id',
    ];

    public function client()
    {
    	return $this->belongsTo('App\Client');
    }

    public function organization()
    {
    	return $this->belongsTo('App\Organization');
    }
}
