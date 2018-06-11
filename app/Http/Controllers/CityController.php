<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\City;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\CityBnImplement;

class CityController extends Controller
{
    private $city_implement;

    function __construct(CityBnImplement $city_implement)
    {
        $this->city_implement = $city_implement;
    }

    public function indexCity(Request $request)
    {
        $db_manager = new DBManager();

        try {
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $cities = $this->city_implement->selectCities($conection);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['cities' => $cities]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function indexFilterCity(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('filter') ) {

                $filter_cities = $this->city_implement->selectFilterCities($conection, $request->filter);

            } else 
                throw new \Exception("Filter is required", Constant::BAD_REQUEST);
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['filter_cities' => $filter_cities]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function storeCity(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( !$request->filled('state_id') )
                throw new \Exception("State is required", Constant::BAD_REQUEST);

            if ( !$request->filled('capital') )
                throw new \Exception("Capital is required", Constant::BAD_REQUEST);

            if ( !$request->filled('city_name') )
                throw new \Exception("City name is required", Constant::BAD_REQUEST);

            $city_insert = $this->city_implement
                ->insertCity($conection, $request->state_id, $request->city_name, $request->capital);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['city_insert' => $city_insert], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updateCity(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( !$request->filled('city_id') )
                throw new \Exception("City is required", Constant::BAD_REQUEST);

            if ( !$request->filled('state_id') )
                throw new \Exception("State is required", Constant::BAD_REQUEST);

            if ( !$request->filled('capital') )
                throw new \Exception("Capital is required", Constant::BAD_REQUEST);

            if ( !$request->filled('city_name') )
                throw new \Exception("City name is required", Constant::BAD_REQUEST);

            $city_udpate = $this->city_implement
                ->updateCity($conection, $request->city_id, $request->state_id, $request->city_name, $request->capital);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['city_udpate' => $city_udpate], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedCity(Request $request)
    {
    	$db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( !$request->filled('city_id') )
                throw new \Exception("City is required", Constant::BAD_REQUEST);

            if ( !$request->filled('archived') )
                throw new \Exception("Archived is required", Constant::BAD_REQUEST);

            $city_archived = $this->city_implement
                ->archivedCity($conection, $request->city_id, $request->archived);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['city_archived' => $city_archived], Constant::OK)->header('Content-Type', 'application/json');
    }
}
