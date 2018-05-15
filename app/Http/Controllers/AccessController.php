<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;

class AccessController extends Controller
{
    public function userPermits(Request $request)
    {
    	//if ( ! $request->ajax() ) return redirect('/');

    	$user = User::findOrFail($request->id);

    	if ($user->all_access_column) {
    		
    		return ['all_access_column' => 1];

    	}

    	$user->columns;

    	return ['user' => $user];
    }

    public function rolPermits(Request $request)
    {
    	//if ( ! $request->ajax() ) return redirect('/');

    	$rol = Rol::findOrFail($request->id);

    	if ($rol->all_access_column) {
    		
    		return ['all_access_column' => 1];

    	}

    	$rol->columns;

    	return ['rol' => $rol];
    }

}
