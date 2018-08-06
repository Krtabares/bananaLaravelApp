<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\ProductBnImplement;

class ProductController extends Controller
{

	private $product_implement;

	function __construct( ProductBnImplement $product_implement)
	{
		$this->product_implement = $product_implement;
	}

    public function getProductList(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$products = $this->product_implement->filterProduct($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(json_encode(['products' => $products]), Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function storeProduct(Request $request)
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

			if ( !$request->filled('product') )
				throw new \Exception("product is empty", Constant::BAD_REQUEST);
			else{
				$product = $request->product;
				if($product->condition_id == null){
					throw new \Exception("condition is required", Constant::BAD_REQUEST);
				}
				if($product->unit_id == null){
					throw new \Exception("Unit of mesauretment is required", Constant::BAD_REQUEST);
				}
			}


			// if ( !$request->filled('reference_no') )
			// 	throw new \Exception("Reference number is required", Constant::BAD_REQUEST);

			// if ( !$request->filled('name') )
			// 	throw new \Exception("Third name is required", Constant::BAD_REQUEST);
			
			// if ( !$request->filled('third_location') )
			// 	throw new \Exception("Third Location is required", Constant::BAD_REQUEST);

			// if ( $request->third_location['address_1'] == NULL )
			// 	throw new \Exception("Indicate at least one address", Constant::BAD_REQUEST);

			$conection->beginTransaction();

			$product_insert = $this->third_implement->insertThird($conection,$product);

			$conection->commit();
			
		} catch (\Exception $e) {
			
			
			return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($product_insert, Constant::OK)
			->header('Content-Type', 'application/json');
	}

}
