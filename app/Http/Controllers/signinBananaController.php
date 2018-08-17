<?php

namespace App\Http\Controllers;
use App\Http\BnImplements\signinBananaBnImplement;
use App\BananaUtils\ExceptionAnalizer;
use Illuminate\Http\Request;
use App\Constant;

class signinBananaController extends Controller
{
    public $signinBananaBnImplement;
            
    public function __construct(signinBananaBnImplement $signinBananaBnImplement )
    {
        $this->signinBananaBnImplement = $signinBananaBnImplement;
    }

    public function createSignin (Request $request){

        
        try {
            
            if(!$request->filled('nombre')){
                throw new \Exception('Name is required', Constant::BAD_REQUEST);
            }

          /*  if(!$request->filled('description')){
                throw new \Exception('Description is required', Constant::BAD_REQUEST);
            }*/

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
            /*if(!$request->filled('storageURL')){
                throw new \Exception('Storage URL is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('NamestorageURL')){
                throw new \Exception('Name of the storage URL is required', Constant::BAD_REQUEST);
            }*/
            
            $banana_client = $this->signinBananaBnImplement->createClient(
                $request->nombre,
                $request->description,
                $request->bdname,
                $request->bdhost,
                $request->bduser,
                $request->bdpassword,
                $request->bddriver,
                $request->dns,
                $request->nameConBD,
                $request->storageURL,
                $request->NamestorageURL
            );

        } catch (\Exception $e) {

            return ExceptionAnalizer::analizerHTTPResponse($e);

        } 

        return response( ['register' => $banana_client] , Constant::OK)->header('Content-Type', 'application/json');
    }

    public function updateSignin (Request $request)
    {

        try{

            if(!$request->filled('id')){
                throw new \Exception('Id is not either incorrect or in the database', Constant::BAD_REQUEST);
            }

            if(!$request->filled('nombre')){
                throw new \Exception('Name is required', Constant::BAD_REQUEST);
            }

           /* if(!$request->filled('description')){
                throw new \Exception('Description is required', Constant::BAD_REQUEST);
            }*/

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

           /* if(!$request->filled('storageURL')){
                throw new \Exception('Storage URL is required', Constant::BAD_REQUEST);
            }

            if(!$request->filled('NamestorageURL')){
                throw new \Exception('Name of the storage URL is required', Constant::BAD_REQUEST);
            }*/

                $banana_client_Update=$this->signinBananaBnImplement->updateClient(
                $request->id,
                $request->nombre,
                $request->description,
                $request->bdname,
                $request->bdhost,
                $request->bduser,
                $request->bdpassword,
                $request->bddriver,
                $request->dns,
                $request->nameConBD,
                $request->storageURL,
                $request->NamestorageURL
                );

        }catch(\Exception $e){
            return ExceptionAnalizer::analizerHTTPResponse($e);
        }
        
        return response(['update'=> $banana_client_Update], Constant::OK)->header('Content-Type','applicantion/json');
    }
}
