<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\WarehouseBnImplement;

class WarehouseController extends Controller
{
    private $warehouse_implement;


	function __construct(WarehouseBnImplement $warehouse_implement)
	{
		$this->warehouse_implement = $warehouse_implement;
	}

//----------------------------------INDEX---------------------------------------------------------------------------
	public function indexWarehouse(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$warehouses = $this->warehouse_implement->selectWarehouses($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['warehouses' => $warehouses], Constant::OK)->header('Content-Type', 'application/json');

	}


//----------------------------------------CREATE-------------------------------------------------------------------------
	public function createWarehouse(Request $request)
	{
		$db_manager = new DBManager();

		try {

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			if ( !$request->filled('name') )
				throw new \Exception('Name is required', Constant::BAD_REQUEST);

			$warehouse_create = $this->warehouse_implement
				->createWarehouse(
                    $conection,
                    $request->reference,
                    $request->name,
                    $request->warehouse_col,
                    $request->notes
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['warehouse_create' => $warehouse_create], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	//-----------------------------------------UPDATE--------------------------------------------------------------------

	public function updateWarehouse(Request $request)
	{
		$db_manager = new DBManager();

		try {

			

				$conection = $db_manager->getClientBDConecction(
					$request->header('authorization'),
					$request->header('user_id'),
					$request->header('token'),
					$request->header('app'));
		

			if ( !$request->filled('id') )
				throw new \Exception('Warehouse is required', Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception('Name is required', Constant::BAD_REQUEST);

			$warehouse_update = $this->warehouse_implement
				->updateWarehouse(
                    $conection,
                    $request->id,
                    $request->reference,
                    $request->name,
                    $request->warehouse_col,
                    $request->notes
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['warehouse_update' => $warehouse_update], Constant::OK)
			->header('Content-Type', 'application/json');
	}



	//--------------------------------------------DELETE---------------------------------------------------------------

	public function deleteWarehouse(Request $request, $id)
	{
		$db_manager = new DBManager();

		try {

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			if ( !$request->filled('id') )
				throw new \Exception('Warehouse is required', Constant::BAD_REQUEST);

			$warehouse_delete = $this->warehouse_implement
				->deleteWarehouse(
					$conection,
					$id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['warehouse_delete' => $warehouse_delete], Constant::OK)
			->header('Content-Type', 'application/json');
	}
}
