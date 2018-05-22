<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Rol;

class AccessController extends Controller
{
    public function rolPermits(Request $request)
    {
    	$rol = Rol::findOrFail($request->id);

    	if ($rol->all_access_column) return ['all_access_column' => 1];

    	$rol->columns; //relacion de roles con columnas y permisos

    	return ['permits_rol' => $rol];
    }

    public function userPermits(Request $request)
    {

        $user = User::findOrFail($request->id);

        if ($user->all_access_column) return ['all_access_column' => 1];

        $user->columns; //relacion de usuarios con columnas y permisos

        return ['permits_user' => $user];
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

        return ['permits_rol' => $rol];
    }

    public function comparePermits(Request $request)
    {
        $user = User::findOrFail($request->id);

        $permits = DB::select('SELECT pr.column_id, pr.create, pr.read, pr.update, pr.delete
			FROM permissions_rols pr, permissions_users pu
		    WHERE pr.rol_id = :rol_id
			    AND pr.column_id NOT IN (
			        SELECT column_id from permissions_users WHERE user_id = :user_id
			    )
			UNION
		    	SELECT pu.column_id, pu.create, pu.read, pu.update, pu.delete
		        FROM permissions_users pu
		        WHERE pu.user_id = :user_id
		        ORDER BY column_id;', ['rol_id' => $user->rol_id, 'user_id' => $user->id]);

        return ['permits' => $permits];
    }
}
