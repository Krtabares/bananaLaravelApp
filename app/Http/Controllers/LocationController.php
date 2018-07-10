<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\Location;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\LocationBnImplement;

class LocationController extends Controller
{
	private $location_implement;

	function __construct(LocationBnImplement $location_implement)
	{
		$this->location_implement = $location_implement;
	}

	public function indexLocationCountry(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			$countries = $this->location_implement
				->country_implement->selectIdNameCountries($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(json_encode(['countries' => $countries]), Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function indexLocationState(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			if ( !$request->filled('country_id') )
				$request->country_id = '';/*throw new \Exception("Country is required", Constant::BAD_REQUEST);*/

			$states = $this->location_implement
				->state_implement->selectIdNameStates($conection, $request->country_id);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(json_encode(['states' => $states]), Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function indexLocationCity(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app')
			);

			if ( !$request->filled('state_id') )
				$request->state_id = '';/*throw new \Exception("State is required", Constant::BAD_REQUEST);*/

			$cities = $this->location_implement
				->city_implement->selectIdNameCities($conection, $request->state_id);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(json_encode(['cities' => $cities]), Constant::OK)
			->header('Content-Type', 'application/json');
	}
}
