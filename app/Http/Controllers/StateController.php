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
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

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
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

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

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            if ( !$request->filled('country_id') )
                throw new \Exception("Country is required", Constant::BAD_REQUEST);

            if ( !$request->filled('iso') )
                throw new \Exception("ISO is required", Constant::BAD_REQUEST);

            if ( !$request->filled('state_name') )
                throw new \Exception("State name is required", Constant::BAD_REQUEST);

            $state_insert = $this->state_implement
                ->insertState($conection, $request->country_id, $request->state_name, $request->iso);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['state_insert' => $state_insert], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updateState(Request $request)
    {
        $db_manager = new DBManager();

        try {

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            if ( !$request->filled('state_id') )
                throw new \Exception("State is required", Constant::BAD_REQUEST);

            if ( !$request->filled('country_id') )
                throw new \Exception("Country is required", Constant::BAD_REQUEST);

            if ( !$request->filled('iso') )
                throw new \Exception("ISO is required", Constant::BAD_REQUEST);

            if ( !$request->filled('state_name') )
                throw new \Exception("State name is required", Constant::BAD_REQUEST);

            $state_update = $this->state_implement
                ->updateState($conection, $request->state_id, $request->country_id, $request->state_name, $request->iso);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['state_update' => $state_update], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedState(Request $request)
    {
        $db_manager = new DBManager();

        try {

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user_id'),
                $request->header('token'),
                $request->header('app'));

            if ( !$request->filled('state_id') )
                throw new \Exception("State is required", Constant::BAD_REQUEST);

            if ( !$request->filled('archived') )
                throw new \Exception("Archived is required", Constant::BAD_REQUEST);

            $state_archived = $this->state_implement->archivedState($conection, $request->state_id, $request->archived);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['state_archived' => $state_archived], Constant::OK)->header('Content-Type', 'application/json');
    }
}
