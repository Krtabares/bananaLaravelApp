<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BananaClient extends Model
{
    //protected $table = 'categories';
    protected $fillable = [
    	'id', 
    	'client_name',
    	'client_description',
    	'client_DB_name',
    	'client_DB_host',
    	'client_DB_user',
		'client_DB_password',
		'client_DB_driver',
		'client_DB_dns',
    	'client_name_conecction_BD'
    ];
}
