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

            $rols = $this->rol_implement->selectRol($conection);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['rols' => $rols]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function storeRol(Request $request)
    {
        $db_manager = new DBManager();

        try {

            //dd( $request->header('authorization') );

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $response = $this->rol_implement->insertRol($conection, $request->rol_name, $request->description, $request->all_access_column);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response($response, Constant::OK)->header('Content-Type', 'application/json');
    }


    public function storePermitsRol(Request $request)
    {
        return $request->permits;
    }

}
