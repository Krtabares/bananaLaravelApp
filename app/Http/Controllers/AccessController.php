<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\AccessBnImplement;
use App\Http\BnImplements\CustomColumnsBnImplement;
use App\Http\BnImplements\RolBnImplement;
use App\Http\BnImplements\UserBnImplement;
use App\User;
use App\Rol;

class AccessController extends Controller
{
    private $rol_implement;
    private $user_implement;
    private $table_implement;
    private $access_implement;

    public function __construct(RolBnImplement $rol_implement, UserBnImplement $user_implement, AccessBnImplement $access_implement,
        CustomColumnsBnImplement $customColumns_implement){
        $this->rol_implement = $rol_implement;
        $this->user_implement = $user_implement;
        $this->access_implement = $access_implement;
        $this->customColumns_implement = $customColumns_implement;
    }

    public function columnsTableAccess(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            if ( $request->filled('table_id') ) {

                $columns = $this->access_implement->SelectColumnAccessUser($conection,$request->header('user_id'), $request->table_id);
                $custom_columns = $this->customColumns_implement->getCustomColumnsByTable($conection,$request->table_id);
                 // $columns = [];

            } else 
                throw new \Exception("Table id is required", Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['columns' => $columns, 'custom_columns'=>$custom_columns]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function userTableAccess(Request $request)
    {
        $db_manager = new DBManager();

        try {   
            
            dd( $request );
			/* if ( !$request->hasHeader('authorization') )
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST); */
                
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            // if ( $request->filled('user_id') ) {

                $tables = $this->access_implement->selectTableAccessUser($conection, $request->header('user_id'));

            // } else 
            //     throw new \Exception("User id is required", Constant::BAD_REQUEST);

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
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            if ( $request->filled('rol_id') ) {

                $permits_rol = $this->rol_implement->selectAllPermitsRol($conection, $request->rol_id);

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
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            if ( $request->filled('user_id') ) {

                $permits_user = $this->user_implement->selectAllPermitsUser($conection, $request->user_id);

            } else 
                throw new \Exception("User id is required", Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['permits_user' => $permits_user]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function totalAccess(Request $request)
    {
        $db_manager = new DBManager();

        try {
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            if ( $request->filled('user_id') ) {

                $total_permits = $this->access_implement->selectTotalAccess($conection, $request->user_id);

            } else 
                throw new \Exception("User id is required", Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['total_permits' => $total_permits]), Constant::OK)->header('Content-Type', 'application/json');
    }
}
