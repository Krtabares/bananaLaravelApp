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

    public function selectContactById(Request $request)
    {
    	$db_manager = new DBManager();

		try {

			$conection = $db_manager->getClientBDConecction(
				$request->header('authorization'),
				$request->header('contact_id'),
				$request->header('token'),
				$request->header('app'));

			$contact = $this->contact_implement->selectContactById($conection, $contact_id);

		} catch (\Exception $e) {
			
			return ExceptionAnalizer::analizerHTTPResponse($e);

		} finally {
			$db_manager->terminateClientBDConecction();
		}

		return response(['contact' => $contact], Constant::OK)
			->header('Content-Type', 'application/json');
    }

    public function updateContact(Request $request)
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
}
