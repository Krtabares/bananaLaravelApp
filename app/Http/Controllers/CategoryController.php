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

	public function createCategory(Request $request)
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

			$category_create = $this->category_implement
				->createCategory(
					$conection,
					$request->name,
					$request->color,
					$request->parent_id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['category_create' => $category_create], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function updateCategory(Request $request)
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
				throw new \Exception('Category is required', Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception('Name is required', Constant::BAD_REQUEST);

			$category_update = $this->category_implement
				->updateCategory(
					$conection,
					$request->id,
					$request->name,
					$request->color,
					$request->parent_id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['category_update' => $category_update], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function archivedCategory(Request $request)
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
				throw new \Exception('Category is required', Constant::BAD_REQUEST);

			if ( !$request->filled('archived') )
				throw new \Exception('Archived is required', Constant::BAD_REQUEST);

			$category_archived = $this->category_implement
				->archivedCategory(
					$conection,
					$request->id,
					$request->archived
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['category_archived' => $category_archived], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function deleteCategory(Request $request)
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
				throw new \Exception('Category is required', Constant::BAD_REQUEST);

			$category_delete = $this->category_implement
				->deleteCategory(
					$conection,
					$request->id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['category_delete' => $category_delete], Constant::OK)
			->header('Content-Type', 'application/json');
	}
}