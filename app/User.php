<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rol_id', 'name', 'email', 'password', 'all_access_organization', 'all_access_column'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    public function organizations()
    {
        return $this->belongsToMany('App\Organization')->withTimestamps();
    }

    public function columns()
    {
        return $this->belongsToMany('App\Column', 'permissions_users')
            ->as('permission_user')
            ->withPivot('create', 'read', 'update', 'delete')
            ->withTimestamps();
    }
}
