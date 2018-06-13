<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\Http\BnImplements\LoginBnImplement;


class LoginController extends Controller
{

    private $login_implement;

    function __construct(LoginBnImplement $login_implement)
    {
        $this->login_implement = $login_implement;
    }

	public function login(Request $request)
	{

        $db_manager = new DBManager();

        try { 
            // dd($request);
            if(!$request->filled('authorization')){
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::UNAUTHORIZED);
            }

            $conection = $db_manager->getClientBDConecction($request->authorization,NULL,Constant::TOKEN_LOGIN,NULL);

            if(!$request->filled('email')){
            	throw new \Exception("Email es un campo requerido", Constant::BAD_REQUEST);
            }
            if(!$request->filled('password')){
            	throw new \Exception("Password es un campo requerido", Constant::BAD_REQUEST);
            }
            if(!$request->filled('app')){
                throw new \Exception("App es un campo requerido", Constant::BAD_REQUEST);
            }

            $user = $this->login_implement->login($conection,$request->email,$request->password,$request->app);


        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response(json_encode($user), Constant::OK)->header('Content-Type', 'application/json');
    }
	
}
