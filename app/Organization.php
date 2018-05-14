<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['client_id', 'organization_name', 'description', 'archived'];
}
