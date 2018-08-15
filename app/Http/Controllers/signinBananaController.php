<?php

namespace App\Http\Controllers;
use App\Http\BnImplements\signinBananaBnImplement;
use App\BananaUtils\ExceptionAnalizer;
use Illuminate\Http\Request;
use App\Constant;

class signinBananaController extends Controller
{
    public $signinBananaImplement;

    public function __construct(signinBananaBnImplement $signinBananaBnImplement )
    {
        $this->signinBananaImplement = $signinBananaBnImplement;
    }

    public function createSignin (Request $request){

        
        try {
            
            if(!$request->filled('nombre')){
                throw new \Exception('Name is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('description')){
                throw new \Exception('Description is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('bdname')){
                throw new \Exception('name of BD is required', Constant::BAD_REQUEST);
            }
            if(!$request->filled('bdhost')){
                throw new \Exception('bdhost is required', Constant::BAD_REQUEST);
            }
            if(!$request->filled('bduser')){
                throw new \Exception(' BDD user is required', Constant::BAD_REQUEST);
            }
            if(!$request->filled('bdpassword')){
                throw new \Exception(' BDD password is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('bddriver')){
                throw new \Exception(' driver is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('dns')){
                throw new \Exception('DNS is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('nameConBD')){
                throw new \Exception('Client name conection is required', Constant::BAD_REQUEST);
            }
            
            $banana_client = $this->signinBananaImplement->createClient(
                $request->nombre,
                $request->description,
                $request->bdname,
                $request->bdhost,
                $request->bduser,
                $request->bdpassword,
                $request->bddriver,
                $request->dns,
                $request->nameConBD
            );

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } finally {

            //$db_manager->terminateClientBDConecction();
        }

        return response( ['register' => $banana_client] , Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updateSignin (Request $requet)
    {

        try{

            if(!$request->filled('nombre')){
                throw new \Exception('Name is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('description')){
                throw new \Exception('Description is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('bdname')){
                throw new \Exception(' name of BD is required', Constant::BAD_REQUEST);
            }
            if(!$request->filled('bdhost')){
                throw new \Exception('bdhost is required', Constant::BAD_REQUEST);
            }
            if(!$request->filled('bduser')){
                throw new \Exception(' BDD user is required', Constant::BAD_REQUEST);
            }
            if(!$request->filled('bdpassword')){
                throw new \Exception(' BDD password is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('bddriver')){
                throw new \Exception(' driver is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('nameConBD')){
                throw new \Exception('Client name conection is required', Constant::BAD_REQUEST);
            }
                $banana_client_Update=$this->signinBananaImplement->updatesignin(
                $request->nombre,
                $request->description,
                $request->bdname,
                $request->bdhost,
                $request->bduser,
                $request->bdpassword,
                $request->bddriver,
                $request->bddn,
                $request->nameConBD);
        }catch(\Exception $e){
            return ExceptionAnalizer::analizerHTTPResponse($e);
        }
        
        return response(['update'=> $banana_client_Update], Constant::OK)->header('Content-Type','applicantion/json');
    }
}
