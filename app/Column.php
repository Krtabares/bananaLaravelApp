<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $fillable = ['table_id', 'column_name', 'description'];

    public function table()
    {
        return $this->belongsTo('App\Table');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'permissions_users')
            ->as('permission_user')
            ->withPivot('create', 'read', 'update', 'delete')
            ->withTimestamps();
    }

    public function rols()
    {
        return $this->belongsToMany('App\Rol', 'permissions_users')
            ->as('permission_user')
            ->withPivot('create', 'read', 'update', 'delete')
            ->withTimestamps();
    }
}
