<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\ContactBnImplement;

class ContactController extends Controller
{
	private $contact_implement;

	public function __construct(ContactBnImplement $contact_implement)
	{
		$this->contact_implement = $contact_implement;
	}

	public function searchContact(Request $request)
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

			if ( !$request->filled('search') )
				throw new \Exception('Search is required', Constant::BAD_REQUEST);

			$search_contacts = $this->contact_implement->searchContact($conection, $request->search);

		} catch (\Exception $e) {
			
			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {
			$db_manager->terminateClientBDConecction();
		}

		return response(['search_contacts' => $search_contacts], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function updateContact(Request $request)
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
				throw new \Exception('Contact is required', Constant::BAD_REQUEST);

			if ( !$request->filled('name') )
				throw new \Exception('Contact name is required', Constant::BAD_REQUEST);

			$conection->beginTransaction();

			$contact_update = $this->contact_implement
				->updateContact(
					$conection,
					$request->id,
					$request->name,
					$request->description,
					$request->comments,
					$request->email,
					$request->phone,
					$request->phone_2,
					$request->fax,
					$request->title,
					$request->birthday,
					$request->last_contact,
					$request->last_result
				);

			$conection->commit();

		} catch (\Exception $e) {

			$conection->rollBack();
			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['contact_update' => $contact_update], Constant::OK)
			->header('Content-Type', 'application/json');
	}

	public function archivedContact(Request $request)
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

			if ( !$request->filled('contact_id') )
				throw new \Exception("Contact is required", Constant::BAD_REQUEST);

			if ( !$request->filled('archived') )
				throw new \Exception("Archived is required", Constant::BAD_REQUEST);

			$contact_archived = $this->contact_implement
				->archivedContact($conection, $request->contact_id, $request->archived);
			
		} catch (\Exception $e) {
			
			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {

			$db_manager->terminateClientBDConecction();
		}

		return response(['contact_archived' => $contact_archived], Constant::OK)
			->header('Content-Type', 'application/json');
	}

}
