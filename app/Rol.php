<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = ['rol_name', 'description', 'all_access_column'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function columns()
    {
        return $this->belongsToMany('App\Column', 'permissions_rols')
            ->as('permission_rol')
            ->withPivot('create', 'read', 'update', 'delete')
            ->withTimestamps();
    }
}
