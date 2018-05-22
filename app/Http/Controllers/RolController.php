<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use Illuminate\Support\Facades\DB;
use App\Rol;

class RolController extends Controller
{
    public function indexRol(Request $request)
    {
    	$rol = DB::select('CALL RD_Rols()');

    	return $rol;
    }

    public function storeRol(Request $request)
    {
    	try {

    		DB::beginTransaction();

    		DB::select('CALL CR_Rols(:rol_name, :description, :all_access_column)', [
	    		'rol_name' => $request->rol_name,
	    		'description' => $request->description,
	    		'all_access_column' => $request->all_access_column
	    	]);

	    	/*
				insertar permisos
	    	*/

    	} catch (\Illuminate\Database\QueryException $e) {
    		
    		switch ( $e->errorInfo[1] ) {
    			
    			case Constant::DUPLICATE :
    				return response( Constant::MSG_DUPLICATE , Constant::NOT_IMPLEMENTED)
    					->header('Content-Type', 'application/json');
    			break;

    			case Constant::TOO_LONG :
    				return response( Constant::MSG_TOO_LONG , Constant::NOT_IMPLEMENTED)
    					->header('Content-Type', 'application/json');
    			break;

    			default:
    				return response( Constant::MSG_ERROR_DB , Constant::NOT_IMPLEMENTED)
    					->header('Content-Type', 'application/json'); 
    			break;
    		}

    		DB::rollBack();

    	} catch (Exception $e) {
    	
    		return response($e->getMessage(), Constant::INTERNAL_SERVER_ERROR);

    		DB::rollBack();
    	
    	}

    	return response( Constant::MSG_SUCCESS , Constant::OK)->header('Content-Type', 'application/json');
    }
}
