<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\Country;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\CountryBnImplement;

class CountryController extends Controller
{
    private $country_implement;

    function __construct(CountryBnImplement $country_implement)
    {
        $this->country_implement = $country_implement;
    }

    public function indexCountry(Request $request)
    {
        $db_manager = new DBManager();

        try {
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            $countries = $this->country_implement->selectCountries($conection);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['countries' => $countries]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function indexFilterCountry(Request $request)
    {
        $db_manager = new DBManager();

        try {   
             
            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('filter') ) {

                $filter_countries = $this->country_implement->selectFilterCountries($conection, $request->filter);

            } else 
                throw new \Exception("Filter is required", Constant::BAD_REQUEST);
            

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode(['filter_countries' => $filter_countries]), Constant::OK)->header('Content-Type', 'application/json');
    }

    public function storeCountry(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('iso') && $request->filled('country_name') ) {

                $this->country_implement
                    ->insertCountry($conection, $request->country_name, $request->iso);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(Constant::MSG_INSERT, Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updateCountry(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('country_id') && $request->filled('iso') && $request->filled('country_name') ) {

                $this->country_implement
                    ->updateCountry($conection, $request->country_id, $request->country_name, $request->iso);

            } else 
                throw new \Exception("One or more parameters are required", Constant::BAD_REQUEST);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(Constant::MSG_UPDATE, Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedCountry(Request $request)
    {
        $db_manager = new DBManager();

        try {

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if ( $request->filled('country_id') && $request->filled('archived') ) {

                $this->country_implement->archivedCountry($conection, $request->country_id, $request->archived);

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
