<?php

namespace App\Http\Controllers;
use App\Http\BnImplements\signinBananaBnImplement;
//use App\BananaUtils\DBManager;
use Illuminate\Http\Request;
use App\Constant;

class signinBananaController extends Controller
{
    public $signinBananaImplement;

    public function __construct(signinBananaBnImplement $signinBananaImplement )
    {
        $this->signinBananaImplement = $signinBnanaBnImplement;
    }

    public function signinConection (Request $request){

        
        try {
            
            $banana_client = $this->signinBananaImplement->createClient();

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            $db_manager->terminateClientBDConecction();
        }

        return response( ['register' => $banana_client] , Constant::OK)->header('Content-Type', 'application/json');
    }
}
