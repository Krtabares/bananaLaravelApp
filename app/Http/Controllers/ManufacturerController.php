<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\ManufacturerBnImplement;

class ManufacturerController extends Controller
{
	private $manufacturer_implement;


	function __construct(ManufacturerBnImplement $manufacturer_implement)
	{
		$this->manufacturer_implement = $manufacturer_implement;
	}


//----------------------------------INDEX---------------------------------------------------------------------------
	public function indexManufacturer(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$manufacturers = $this->manufacturer_implement->selectManufacturers($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['manufacturers' => $manufacturers], Constant::OK)->header('Content-Type', 'application/json');
	}



	//----------------------------------------CREATE-------------------------------------------------------------------------
	public function createManufacturer(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

				$conection = $db_manager->getClientBDConecction(
					$request->header('authorization'),
					$request->header('user_id'),
					$request->header('token'),
					$request->header('app')
				);

			if ( !$request->filled('name') )
				throw new \Exception('Name is required', Constant::BAD_REQUEST);

			$manufacturer_create = $this->manufacturer_implement
				->createManufacturer(
					$conection,
					$request->name
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['manufacturer_create' => $manufacturer_create], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	//-----------------------------------------UPDATE--------------------------------------------------------------------
	public function updateManufacturer(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

				$conection = $db_manager->getClientBDConecction(
					$request->header('authorization'),
					$request->header('user_id'),
					$request->header('token'),
					$request->header('app')
				);

			if ( !$request->filled('id') )
				throw new \Exception('Manufacturer is required', Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception('Name is required', Constant::BAD_REQUEST);

			$manufacturer_update = $this->manufacturer_implement
				->updateManufacturer(
					$conection,
					$request->id,
					$request->name
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['manufacturer_update' => $manufacturer_update], Constant::OK)
			->header('Content-Type', 'application/json');
	}


	//-----------------------------------------UPDATE-ARCHIVE--------------------------------------------------------------------
	public function archivedManufacturer(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

				$conection = $db_manager->getClientBDConecction(
					$request->header('authorization'),
					$request->header('user_id'),
					$request->header('token'),
					$request->header('app')
				);

			if ( !$request->filled('id') )
				throw new \Exception('Manufacturer is required', Constant::BAD_REQUEST);

			if ( !$request->filled('archived') )
				throw new \Exception('Archived is required', Constant::BAD_REQUEST);

			$manufacturer_archived = $this->manufacturer_implement
				->archivedManufacturer(
					$conection,
					$request->id,
					$request->archived
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['manufacturer_archived' => $manufacturer_archived], Constant::OK)
			->header('Content-Type', 'application/json');
	}


	//--------------------------------------------DELETE---------------------------------------------------------------
	public function deleteManufacturer(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

				$conection = $db_manager->getClientBDConecction(
					$request->header('authorization'),
					$request->header('user_id'),
					$request->header('token'),
					$request->header('app')
				);

			if ( !$request->filled('id') )
				throw new \Exception('Manufacturer is required', Constant::BAD_REQUEST);

			$manufacturer_delete = $this->manufacturer_implement
				->deleteManufacturer(
					$conection,
					$request->id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['manufacturer_delete' => $manufacturer_delete], Constant::OK)
			->header('Content-Type', 'application/json');
	}
}
