<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\Location;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\PriceListBnImplement;

class PriceListController extends Controller
{
	private $price_list_implement;


	function __construct(PriceListBnImplement $price_list_implement)
	{
		$this->price_list_implement = $price_list_implement;
	}

	//----------------------------------INDEX---------------------------------------------------------------------------
	public function indexPriceList(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$price_lists = $this->price_list_implement->selectPriceLists($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['price_lists' => $price_lists], Constant::OK)->header('Content-Type', 'application/json');
	}

	//----------------------------------------CREATE-------------------------------------------------------------------------
	public function createPriceList(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

				$conection = $db_manager->getClientBDConecction(
					$request->header('authorization'),
					$request->header('user_id'),
					$request->header('token'),
					$request->header('app'));

			if ( !$request->filled('reference') )
				throw new \Exception('Reference is required', Constant::BAD_REQUEST);

			if ( !$request->filled('tax_include') )
				throw new \Exception('Tax is required', Constant::BAD_REQUEST);

			if ( !$request->filled('currency_id') )
				throw new \Exception('Currency is required', Constant::BAD_REQUEST);

			$price_list_create = $this->price_list_implement
				->createPriceList(
					$conection,
					$request->reference,
					$request->name,
					$request->valid_from,
					$request->valid_until,
					$request->tax_include,
					$request->currency_id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['price_list_create' => $price_list_create], Constant::OK)
			->header('Content-Type', 'application/json');
	}


	//-----------------------------------------UPDATE--------------------------------------------------------------------
	public function updatePriceList(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->filled('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);

				$conection = $db_manager->getClientBDConecction(
					$request->header('authorization'),
					$request->header('user_id'),
					$request->header('token'),
					$request->header('app'));

			if ( !$request->filled('id') )
				throw new \Exception('Price list is required', Constant::BAD_REQUEST);

			if ( !$request->filled('reference') )
				throw new \Exception('Reference is required', Constant::BAD_REQUEST);

			if ( !$request->filled('tax_include') )
				throw new \Exception('Tax is required', Constant::BAD_REQUEST);

			if ( !$request->filled('currency_id') )
				throw new \Exception('Currency is required', Constant::BAD_REQUEST);

			$price_list_update = $this->price_list_implement
				->updatePriceList(
					$conection,
					$request->id,
					$request->reference,
					$request->name,
					$request->valid_from,
					$request->valid_until,
					$request->tax_include,
					$request->currency_id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['price_list_update' => $price_list_update], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	
	//--------------------------------------------DELETE---------------------------------------------------------------
	public function deletePriceList(Request $request)
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
				throw new \Exception('PriceList is required', Constant::BAD_REQUEST);

			$price_list_delete = $this->price_list_implement
				->deletePriceList(
					$conection,
					$request->id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['price_list_delete' => $price_list_delete], Constant::OK)
			->header('Content-Type', 'application/json');
	}
}
