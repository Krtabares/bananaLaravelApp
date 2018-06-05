<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\State;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\StateBnImplement;

class StateController extends Controller
{
    private $state_implement;

    function __construct(StateBnImplement $state_implement)
    {
        $this->state_implement = $state_implement;
    }

    public function indexState(Request $request)
    {
        $db_manager = new DBManager();

        try {
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $states = $this->state_implement->selectStates($conection);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['states' => $states]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function indexFilterState(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('filter') ) {

                $filter_states = $this->state_implement->selectFilterStates($conection, $request->filter);

            } else 
                throw new \Exception("Filter is required", Constant::BAD_REQUEST);
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['filter_states' => $filter_states]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function storeState(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('country_id') && $request->filled('iso') && $request->filled('state_name') ) {

                $this->state_implement
                    ->insertState($conection, $request->country_id, $request->state_name, $request->iso);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(Constant::MSG_INSERT, Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updateState(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('state_id') && $request->filled('country_id') && $request->filled('iso')
                && $request->filled('state_name') ) {

                $this->state_implement
                    ->updateState($conection, $request->state_id, $request->country_id, $request->state_name, $request->iso);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(Constant::MSG_UPDATE, Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedState(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('state_id') && $request->filled('archived') ) {

                $this->state_implement->archivedState($conection, $request->state_id, $request->archived);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(Constant::MSG_ARCHIVED, Constant::OK)->header('Content-Type', 'application/json');
    }
}
