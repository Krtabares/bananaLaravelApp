<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Constant;
use App\BananaUtils\DBManager;
use App\BananaUtils\ExceptionAnalizer;
use App\BananaUtils\FilesUtils;
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
        $storageManager = new FilesUtils();
        try {

            if( !$request->hasHeader('authorization') ){
                throw new \Exception(Constant::MSG_UNAUTHORIZED, Constant::UNAUTHORIZED);
            }

            $conection = $db_manager->getClientBDConecction($request->header('authorization'),NULL,Constant::TOKEN_LOGIN,NULL);
            // $storageUrl = $storageManager->setStorageSimple($request->header('authorization'));
            // dd($storageUrl);
            if(!$request->filled('email')){
            	throw new \Exception("Email es un campo requerido", Constant::BAD_REQUEST);
            }
            if(!$request->filled('password')){
            	throw new \Exception("Password es un campo requerido", Constant::BAD_REQUEST);
            }

            $user = $this->login_implement->login($conection,$request->email,$request->password,$request->header('app'));


        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e, $conection);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

         return response(json_encode(['user'=>$user, 'storage'=>$db_manager->client_storageURL, 'storageName'=>$db_manager->client_name_storageURL]), Constant::OK)->header('Content-Type', 'application/json');
    }

}
