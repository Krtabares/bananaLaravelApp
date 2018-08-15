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
             
            $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));


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
             
             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

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

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

            if ( !$request->filled('iso') )
                throw new \Exception("ISO is required", Constant::BAD_REQUEST);

            if ( !$request->filled('country_name') )
                throw new \Exception("Country name is required", Constant::BAD_REQUEST);

            $country_insert = $this->country_implement
                ->insertCountry($conection, $request->country_name, $request->iso);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['country_insert' => $country_insert], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updateCountry(Request $request)
    {
        $db_manager = new DBManager();

        try {

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

            if ( !$request->filled('country_id') )
                throw new \Exception("Country is required", Constant::BAD_REQUEST);

            if ( !$request->filled('iso') )
                throw new \Exception("ISO is required", Constant::BAD_REQUEST);

            if ( !$request->filled('country_name') )
                throw new \Exception("Country name is required", Constant::BAD_REQUEST);

            $country_update = $this->country_implement
                ->updateCountry($conection, $request->country_id, $request->country_name, $request->iso);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['country_update' => $country_update], Constant::OK)->header('Content-Type', 'application/json');
    }

    public function archivedCountry(Request $request)
    {
        $db_manager = new DBManager();

        try {

             $conection = $db_manager->getClientBDConecction(
                $request->header('authorization'),
                $request->header('user'),
                $request->header('token'),
                $request->header('app'));

            if ( !$request->filled('country_id') )
                throw new \Exception("Country is required", Constant::BAD_REQUEST);

            if ( !$request->filled('archived') )
                throw new \Exception("Archived is required", Constant::BAD_REQUEST);

            $country_archived = $this->country_implement->archivedCountry($conection, $request->country_id, $request->archived);
            
        } catch (\Exception $e) {
            
            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(['country_archived' => $country_archived], Constant::OK)->header('Content-Type', 'application/json');
    }
}
