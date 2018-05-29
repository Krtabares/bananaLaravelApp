<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\UserBnImplement;

class UserController extends Controller
{

	private $user_implement;


	function __construct(UserBnImplement $user_implement)
	{
		$this->user_implement = $user_implement;
	}


    public function getUserByEmail(Request $request)
    {        
        $db_manager = new DBManager();

        try {   

            $conection = $db_manager->getClientBDConecction($request->header('authorization'));

            if($request->filled('email')){
            	 $user = $this->user_implement->getUserByEmail($conection,$request->email);
            }else 
            	 throw new \Exception("Email es un campo requerido", Constant::BAD_REQUEST);

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode($user), Constant::OK)->header('Content-Type', 'application/json');
    }
}
