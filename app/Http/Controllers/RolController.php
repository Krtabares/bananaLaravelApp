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
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

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
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $rol = $this->rol_implement->selectRolById($conection, $id);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode([$rol]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function indexFilterRol(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

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

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));
            $conection->beginTransaction();

            if ( $request->filled('rol_name') && $request->filled('description') && $request->filled('all_access_column') ) {

                $rol_insert = $this->rol_implement
                    ->insertRol($conection, $request->rol_name, $request->description, $request->all_access_column);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);

            if ( $request->filled('permits_rol') ) {

                foreach ($request->permits_rol as $key => $permit_rol) {
                    
                    $this->rol_implement
                        ->insertPermitsRol($conection, $rol_insert->id, $permit_rol['column_id'], $permit_rol['create'],
                        $permit_rol['read'], $permit_rol['update'], $permit_rol['delete']);

                }

            }

            $permits_rol = $this->rol_implement->selectAllPermitsRol($conection, $rol_insert->id);

            $conection->commit();
            
        } catch (\Exception $e) {
            
            $conection->rollBack();
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['rol_insert' => $rol_insert, 'permits_rol' => $permits_rol], Constant::OK)
            ->header('Content-Type', 'application/json');
    }

    public function updateRol(Request $request)
    {

        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));
            $conection->beginTransaction();

            if ( $request->filled('rol_id') && $request->filled('rol_name') && $request->filled('description')
                    && $request->filled('all_access_column') ) {

                $rol_update = $this->rol_implement
                    ->updateRol($conection, $request->rol_id, $request->rol_name, $request->description,
                        $request->all_access_column);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);

            if ( $request->filled('rol_id') && $request->filled('permits_rol') ) {

                foreach ($request->permits_rol as $key => $permit_rol) {
                    
                    $this->rol_implement
                        ->updatePermitsRol($conection, $request->rol_id, $permit_rol['column_id'], $permit_rol['create'],
                        $permit_rol['read'], $permit_rol['update'], $permit_rol['delete']);

                }
                
            }

            $permits_rol = $this->rol_implement->selectAllPermitsRol($conection, $rol_update->id);

            $conection->commit();
            
        } catch (\Exception $e) {
            
            $conection->rollBack();
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['rol_update' => $rol_update, 'permits_rol' => $permits_rol], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedRol(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('rol_id') && $request->filled('archived') ) {

                $rol_archived = $this->rol_implement->archivedRol($conection, $request->rol_id, $request->archived);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['rol_archived' => $rol_archived], Constant::OK)->header('Content-Type', 'application/json');
    }

}
