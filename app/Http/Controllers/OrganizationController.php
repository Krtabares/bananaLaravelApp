<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\OrganizationBnImplement;

class OrganizationController extends Controller
{
    private $organization_implement;


	function __construct(OrganizationBnImplement $organization_implement)
	{
		$this->organization_implement = $organization_implement;
	}

	public function indexOrganization(Request $request)
	{
		$db_manager = new DBManager();

		try {
				 
			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);
				
			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$organizations = $this->organization_implement->selectOrganizations($conection);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['organizations' => $organizations], Constant::OK)->header('Content-Type', 'application/json');
	}

	public function selectOrganizationById(Request $request, $id)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);
				
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$organization = $this->organization_implement->selectOrganizationById($conection, $id);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($organization, Constant::OK)->header('Content-Type', 'application/json');
	}

	public function indexFilterOrganization(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);
				
			 $conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			if ( $request->filled('filter') ) {

				$filter_organizations = $this->organization_implement->selectFilterOrganizations(
					$conection, $request->filter
				);

			} else
				throw new \Exception("Filter is required", Constant::BAD_REQUEST);


		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($filter_organizations, Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function storeOrganization(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);
				
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			if ( !$request->filled('name') )
				throw new \Exception('Name is required', Constant::BAD_REQUEST);
			
			if ( !$request->filled('reference_no') )
				throw new \Exception('Reference number is required', Constant::BAD_REQUEST);

			$conection->beginTransaction();

			$organization_create = $this->organization_implement
				->createOrganization(
					$conection,
					$request->name,
					$request->reference_no,
					$request->description,
					$request->organization_location
				);
			
			$conection->commit();

		} catch (\Exception $e) {

			$conection->rollBack();
			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['organization_create' => $organization_create], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function updateOrganization(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);
				
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			if ( !$request->filled('id') )
				throw new \Exception('Organization is required', Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception('Name is required', Constant::BAD_REQUEST);
			
			if ( !$request->filled('reference_no') )
				throw new \Exception('Reference number is required', Constant::BAD_REQUEST);

			$conection->beginTransaction();

			$organization_update = $this->organization_implement
				->updateOrganization(
					$conection,
					$request->id,
					$request->name,
					$request->reference_no,
					$request->description,
					$request->organization_location
				);

			$conection->commit();

		} catch (\Exception $e) {

			$conection->rollBack();
			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response($organization_update, Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function archivedOrganization(Request $request)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);
				
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			if ( !$request->filled('id') )
				throw new \Exception('Organization is required', Constant::BAD_REQUEST);

			if ( !$request->filled('archived') )
				throw new \Exception('Archived is required', Constant::BAD_REQUEST);

			$organization_archived = $this->organization_implement
				->archivedOrganization(
					$conection,
					$request->id,
					$request->archived
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['organization_archived' => $organization_archived], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function deleteOrganization(Request $request, $id)
	{
		$db_manager = new DBManager();

		try {

			if ( !$request->hasHeader('authorization') )
				throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::BAD_REQUEST);
				
			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('user_id'),
				$request->header('token'),
				$request->header('app'));

			$organization_delete = $this->organization_implement
				->deleteOrganization(
					$conection,
					$id
				);

		} catch (\Exception $e) {

			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['organization_delete' => $organization_delete], Constant::OK)
			->header('Content-Type', 'application/json');
	}
}