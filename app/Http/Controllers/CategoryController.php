<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\CategoryBnImplement;

class CategoryController extends Controller
{
	private $category_implement;


	function __construct(CategoryBnImplement $category_implement)
	{
		$this->category_implement = $category_implement;
	}

	public function indexCategory(Request $request)
	{
		$db_manager = new DBManager();

		try {
			 
			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$categories = $this->category_implement->selectCategories($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['categories' => $categories], Constant::OK)->header('Content-Type', 'application/json');
	}
}