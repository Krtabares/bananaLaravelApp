<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;

class AccessController extends Controller
{
    public function rolPermits(Request $request)
    {
    	//if ( ! $request->ajax() ) return redirect('/');

    	$rol = Rol::findOrFail($request->id);

    	if ($rol->all_access_column) return ['all_access_column' => 1];

    	$rol->columns; //relacion de roles con columnas y permisos

    	return ['rol' => $rol];
    }

    public function userPermits(Request $request)
    {
        //if ( ! $request->ajax() ) return redirect('/');

        $user = User::findOrFail($request->id);

        if ($user->all_access_column) return ['all_access_column' => 1];

        $user->columns; //relacion de usuarios con columnas y permisos

        return ['user' => $user];
    }

    /*
        Metodo privado que permite obtener los permisos del rol de un usuario
        usando como parametro el id del usuario
    */
    private function permitsRolOfUser(Request $request)
    {
        $rol = User::findOrFail($request->id)->rol;

        if ($rol->all_access_column) return ['all_access_column' => 1];
        
        $rol->columns; //relacion de roles con columnas y permisos

        return ['rol' => $rol];
    }

    public function comparePermits(Request $request)
    {
        //if ( ! $request->ajax() ) return redirect('/');

        $user = $this->userPermits($request);
        $rol = $this->permitsRolOfUser($request);

        //Si el usuario o el rol tienen acceso total a las columnas, se retorna '1'
        if ( isset( $user['all_access_column'] ) )
            return ['all_access_column' => 1];

        if ( isset( $rol['all_access_column'] ) )
            return ['all_access_column' => 1];

        // Se copian solo los permisos del usuario y el rol en un arreglo
        foreach ($user['user']->columns as $key => $column_user) {
            $permits_user[] = $column_user->permission_user;
        }

        foreach ($rol['rol']->columns as $key => $column_rol) {
            $permits_rol[] = $column_rol->permission_rol;
        }

        //si el usuario no tiene permisos de usuario, retorna los permisos del rol
        if ( !isset($permits_user) )
            return ['evaluate permits' => $permits_rol];

        //una copia de los permisos del rol. Esta sera modificada
        $evaluated_permits = $permits_rol;

        foreach ($permits_user as $key_permit_user => $permit_user) {
            
            $flag = false;
            
            foreach ($evaluated_permits as $key_evaluated_permit => $evaluated_permit) {

                if ( $permit_user->column_id == $evaluated_permit->column_id ) {
                    
                    $flag = true;
                    
                    foreach (['create', 'read', 'update', 'delete'] as $key_permit => $permit) {
                
                        if ( $permit_user->$permit != null ) {
                            
                            $evaluated_permits[$key_evaluated_permit]->$permit = $permit_user->$permit;

                        }
                    }
                    break;
                }
            }
            if ( !$flag ) $evaluated_permits[] = $permits_user[$key_permit_user];
        }

        return ['evaluate permits' => $evaluated_permits];
    }
}
