<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\Rol;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\RolBnImplement;

class RolController extends Controller
{
    private $rol_implement;

    public function __construct(RolBnImplement $rol_implement){
        $this->rol_implement = $rol_implement;
    }

    public function indexRol(Request $request)
    {        
        $db_manager = new DBManager();

        try {
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            $rols = $this->rol_implement->selectRols($conection);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['rols' => $rols]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function selectRolById(Request $request, $id)
    {        
        $db_manager = new DBManager();

        try {
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            $rol = $this->rol_implement->selectRolById($conection, $id);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode($rol), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function indexFilterRol(Request $request)
    {
        $db_manager = new DBManager();

        try {   
            
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            if ( $request->filled('filter') ) {

                $filter_rols = $this->rol_implement->selectFilterRols($conection, $request->filter);

            } else 
                throw new \Exception("Filter is required", Constant::BAD_REQUEST);
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['filter_rols' => $filter_rols]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function storeRol(Request $request)
    {
        $db_manager = new DBManager();

        try {
            if(!$request->filled('authorization'))
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::UNAUTHORIZED);

            $conection = $db_manager->getClientBDConecction(
                $request->authorization,
                $request->user_id,
                $request->token,
                $request->app
            );

            $conection->beginTransaction();

            if ( !$request->filled('rol_name') )
                throw new \Exception("Rol name is required", Constant::BAD_REQUEST);

            if ( !$request->filled('description') )
                throw new \Exception("Description is required", Constant::BAD_REQUEST);

            if ( !$request->filled('all_access_column') )
                throw new \Exception("Indicate if you have access to all columns", Constant::BAD_REQUEST);

            if ( !$request->filled('all_access_organization') )
                throw new \Exception("Indicate if you have access to all organization", Constant::BAD_REQUEST);

            if ( !$request->filled('permits_rol') )
                throw new \Exception("Permits rol are required", Constant::BAD_REQUEST);

                $rol_insert = $this->rol_implement
                    ->insertRol($conection, $request->rol_name, $request->description,
                        $request->all_access_column, $request->all_access_organization, $request->permits_rol);

            $conection->commit();
            
        } catch (\Exception $e) {
            
            $conection->rollBack();
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response($rol_insert, Constant::OK)
            ->header('Content-Type', 'application/json');
    }

    public function updateRol(Request $request)
    {

        $db_manager = new DBManager();

        try {
            if(!$request->filled('authorization'))
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::UNAUTHORIZED);

           $conection = $db_manager->getClientBDConecction(
                $request->authorization,
                $request->user_id,
                $request->token,
                $request->app
            );
            $conection->beginTransaction();

            if ( !$request->filled('rol_id') )
                throw new \Exception("Rol is required", Constant::BAD_REQUEST);

            if ( !$request->filled('rol_name') )
                throw new \Exception("Rol name is required", Constant::BAD_REQUEST);

            if ( !$request->filled('description') )
                throw new \Exception("Description is required", Constant::BAD_REQUEST);

            if ( !$request->filled('all_access_column') )
                throw new \Exception("Indicate if you have access to all columns", Constant::BAD_REQUEST);

            if ( !$request->filled('all_access_organization') )
                throw new \Exception("Indicate if you have access to all organization", Constant::BAD_REQUEST);

            if ( !$request->filled('permits_rol') )
                throw new \Exception("Permits rol are required", Constant::BAD_REQUEST);

                $rol_update = $this->rol_implement
                    ->updateRol($conection, $request->rol_id, $request->rol_name, $request->description,
                        $request->all_access_column, $request->all_access_organization, $request->permits_rol);

            $conection->commit();
            
        } catch (\Exception $e) {
            
            $conection->rollBack();
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response($rol_update, Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedRol(Request $request)
    {
        $db_manager = new DBManager();

        try {

            if(!$request->filled('authorization'))
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::UNAUTHORIZED);

           $conection = $db_manager->getClientBDConecction(
                $request->authorization,
                $request->user_id,
                $request->token,
                $request->app
            );

            if ( !$request->filled('rol_id') )
                throw new \Exception("Rol is required", Constant::BAD_REQUEST);

            if ( !$request->filled('archived') )
                throw new \Exception("Archived is required", Constant::BAD_REQUEST);

            $rol_archived = $this->rol_implement->archivedRol($conection, $request->rol_id, $request->archived);

            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response($rol_archived, Constant::OK)->header('Content-Type', 'application/json');
    }




    public function getPermission(Request $request)
    {        
        $db_manager = new DBManager();

        try {
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));
          
            $permissions = $this->rol_implement->selectPermitsRol($conection,$request->id,$request->typeGet);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['permissions' => $permissions]), Constant::OK)->header('Content-Type', 'application/json');
    }

}
