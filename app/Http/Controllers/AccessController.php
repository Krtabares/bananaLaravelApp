<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\AccessBnImplement;
use App\Http\BnImplements\RolBnImplement;
use App\Http\BnImplements\UserBnImplement;
use App\User;
use App\Rol;

class AccessController extends Controller
{
    private $rol_implement;
    private $user_implement;
    private $access_implement;

    public function __construct(RolBnImplement $rol_implement, UserBnImplement $user_implement, AccessBnImplement $access_implement){
        $this->rol_implement = $rol_implement;
        $this->user_implement = $user_implement;
        $this->access_implement = $access_implement;
    }

    /* NO TERMINADO */
    public function tableAccess(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('user_id') ) {

                $tables = $this->access_implement->selectTableAccessUser($conection, $request->user_id);

            } else 
                throw new \Exception("User id is required", Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['tables' => $tables]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function rolPermitsAccess(Request $request)
    {
    	$db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('rol_id') ) {

                $permits_rol = $this->rol_implement->selectPermitsRol($conection, $request->rol_id);

            } else 
                throw new \Exception("Rol id is required", Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['permits_rol' => $permits_rol]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function userPermitsAccess(Request $request)
    {

        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('user_id') ) {

                $permits_user = $this->user_implement->selectPermitsUser($conection, $request->user_id);

            } else 
                throw new \Exception("User id is required", Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['permits_user' => $permits_user]), Constant::OK)->header('Content-Type', 'application/json');
    }

    /* NO TERMINADO */
    public function comparativePermitsAccess(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('user_id') ) {

                $permits = $this->user_implement->selectComparativePermits($conection, $request->user_id);

            } else 
                throw new \Exception("User id is required", Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['permits' => $permits]), Constant::OK)->header('Content-Type', 'application/json');
    }
}
