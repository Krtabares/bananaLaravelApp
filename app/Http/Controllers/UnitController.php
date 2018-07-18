<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\UnitBnImplement;

class UnitController extends Controller
{
	private $unit_implement;


	function __construct(UnitBnImplement $unit_implement)
	{
		$this->unit_implement = $unit_implement;
	}

	public function indexUnit(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$units = $this->unit_implement->selectUnits($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['units' => $units], Constant::OK)->header('Content-Type', 'application/json');
	}

	public function createUnit(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->authorization,
				$request->user_id,
				$request->token,
				$request->app
			);

			if ( !$request->filled('tag') )
				throw new \Exception('Tag is required', Constant::BAD_REQUEST);

			if ( !$request->filled('quantity') )
				throw new \Exception('Quantity is required', Constant::BAD_REQUEST);

			$unit_create = $this->unit_implement
				->createUnit(
					$conection,
					$request->tag,
					$request->quantity
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['unit_create' => $unit_create], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function updateUnit(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->authorization,
				$request->user_id,
				$request->token,
				$request->app
			);

			if ( !$request->filled('id') )
				throw new \Exception('Unit is required', Constant::BAD_REQUEST);

			if ( !$request->filled('tag') )
				throw new \Exception('Tag is required', Constant::BAD_REQUEST);

			if ( !$request->filled('quantity') )
				throw new \Exception('Quantity is required', Constant::BAD_REQUEST);

			$unit_update = $this->unit_implement
				->updateUnit(
					$conection,
					$request->id,
					$request->tag,
					$request->quantity
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['unit_update' => $unit_update], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function archivedUnit(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->authorization,
				$request->user_id,
				$request->token,
				$request->app
			);

			if ( !$request->filled('id') )
				throw new \Exception('Unit is required', Constant::BAD_REQUEST);

			if ( !$request->filled('archived') )
				throw new \Exception('Archived is required', Constant::BAD_REQUEST);

			$unit_archived = $this->unit_implement
				->archivedUnit(
					$conection,
					$request->id,
					$request->archived
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['unit_archived' => $unit_archived], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function deleteUnit(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

			$conection = $db_manager->getClientBDConecction(
				$request->authorization,
				$request->user_id,
				$request->token,
				$request->app
			);

			if ( !$request->filled('id') )
				throw new \Exception('Unit is required', Constant::BAD_REQUEST);

			$unit_delete = $this->unit_implement
				->deleteUnit(
					$conection,
					$request->id,
					$request->archived
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['unit_delete' => $unit_delete], Constant::OK)
			->header('Content-Type', 'application/json');
	}
}
