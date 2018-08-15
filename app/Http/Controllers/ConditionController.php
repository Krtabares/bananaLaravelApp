<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\ConditionBnImplement;

class ConditionController extends Controller
{
	private $condition_implement;


	function __construct(ConditionBnImplement $condition_implement)
	{
		$this->condition_implement = $condition_implement;
	}

	public function indexCondition(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user'),
				$request->header('token'),
				$request->header('app'));

			$conditions = $this->condition_implement->selectConditions($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['conditions' => $conditions], Constant::OK)->header('Content-Type', 'application/json');
	}

	public function createCondition(Request $request)
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

			$condition_create = $this->condition_implement
				->createCondition(
					$conection,
					$request->tag
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['condition_create' => $condition_create], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function updateCondition(Request $request)
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
				throw new \Exception('Condition is required', Constant::BAD_REQUEST);

			if ( !$request->filled('tag') )
				throw new \Exception('Tag is required', Constant::BAD_REQUEST);

			$condition_update = $this->condition_implement
				->updateCondition(
					$conection,
					$request->id,
					$request->tag
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['condition_update' => $condition_update], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function deleteCondition(Request $request)
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
				throw new \Exception('Condition is required', Constant::BAD_REQUEST);

			$condition_delete = $this->condition_implement
				->deleteCondition(
					$conection,
					$request->id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['condition_delete' => $condition_delete], Constant::OK)
			->header('Content-Type', 'application/json');
	}
}
