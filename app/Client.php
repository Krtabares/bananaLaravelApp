<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['client_name', 'description', 'archived', 'language'];

    public function organizations()
    {
        return $this->hasMany('App\Organization');
    }
}
