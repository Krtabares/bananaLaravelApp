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

	function __construct(
		ProductBnImplement $product_implement
	)
	{
		$this->product_implement = $product_implement;
	}

    public function indexThird(Request $request)
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

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(json_encode(['products' => $products]), Constant::OK)
			->header('Content-Type', 'application/json');
	}

}
