<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['client_id', 'organization_name', 'description', 'archived'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
