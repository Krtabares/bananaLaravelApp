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
}
